import os
import sys
import math
import random
import pygame

from scripts.utils import load_image, load_images, Animation  # 載入自定義函式庫
from scripts.entities import PhysicsEntity, Player, Enemy  # 載入自定義角色、物理實體
from scripts.tilemap import Tilemap  # 載入地圖
from scripts.clouds import Clouds  # 載入雲層效果
from scripts.particle import Particle  # 載入粒子效果
from scripts.spark import Spark # 火花特效


# 設定字型
def draw_text(surf, text, size, x, y, color=(255, 255, 255)):
    font = pygame.font.SysFont("arial", size)  # 使用系統內建 Arial 字體
    text_surface = font.render(text, True, color)  # 抗鋸齒=True
    text_rect = text_surface.get_rect()            # 取得文字邊界
    text_rect.centerx = x                          # 設定水平置中
    text_rect.top = y                              # 垂直位置從頂部對齊
    surf.blit(text_surface, text_rect)             # 繪製文字到畫面

class Game:
    def __init__(self):
        pygame.init()  # 初始化 Pygame

        pygame.display.set_caption('ninja game')  # 設定遊戲視窗標題
        self.screen = pygame.display.set_mode((640, 480))  # 設定遊戲視窗大小
        self.display = pygame.Surface((320, 240), pygame.SRCALPHA)  # 設定渲染區域（縮小顯示）
        self.display_2 = pygame.Surface((320, 240))

        self.clock = pygame.time.Clock()  # 設定遊戲幀率控制
        
        self.movement = [False, False]  # 控制玩家移動的布林值，左、右

        # 遊戲資源：圖像、動畫
        self.assets = {
            'decor': load_images('tiles/decor'),  # 裝飾物圖片
            'grass': load_images('tiles/grass'),  # 草地圖片
            'large_decor': load_images('tiles/large_decor'),  # 大型裝飾物
            'stone': load_images('tiles/stone'),  # 石頭圖片
            'player': load_image('entities/player.png'),  # 玩家圖片
            'background': load_image('background.png'),  # 背景圖片
            'clouds': load_images('clouds'),  # 雲層動畫
            'enemy/idle': Animation(load_images('entities/enemy/idle'), img_dur=6),
            'enemy/run': Animation(load_images('entities/enemy/run'), img_dur=4),
            'player/idle': Animation(load_images('entities/player/idle'), img_dur=6),  # 玩家待機動畫
            'player/run': Animation(load_images('entities/player/run'), img_dur=4),  # 玩家奔跑動畫
            'player/jump': Animation(load_images('entities/player/jump')),  # 玩家跳躍動畫
            'player/slide': Animation(load_images('entities/player/slide')),  # 玩家衝刺動畫
            'player/wall_slide': Animation(load_images('entities/player/wall_slide')),  # 玩家牆壁滑行動畫
            'particle/leaf': Animation(load_images('particles/leaf'), img_dur=20, loop=False),  # 粒子 - 葉子動畫
            'particle/particle': Animation(load_images('particles/particle'), img_dur=6, loop=False),  # 粒子 - 普通動畫
            'gun': load_image('gun.png'),   # 槍
            'projectile': load_image('projectile.png'), # 子彈
        }

        # 遊戲音效
        self.sfx = {
            'jump': pygame.mixer.Sound('data/sfx/jump.wav'),            # 跳躍音效
            'dash': pygame.mixer.Sound('data/sfx/dash.wav'),            # 衝刺音效
            'hit': pygame.mixer.Sound('data/sfx/hit.wav'),              # 受傷音效
            'shoot': pygame.mixer.Sound('data/sfx/shoot.wav'),          # 射擊音效
            'ambience': pygame.mixer.Sound('data/sfx/ambience.wav'),    
        }

        self.sfx['ambience'].set_volume(0.2)    
        self.sfx['shoot'].set_volume(0.4)
        self.sfx['hit'].set_volume(0.8)
        self.sfx['dash'].set_volume(0.3)
        self.sfx['jump'].set_volume(0.7)

        self.clouds = Clouds(self.assets['clouds'], count=16)   # 雲層物件
               
        self.player = Player(self, (50, 50), (8, 15))   # 玩家物件
              
        self.tilemap = Tilemap(self, tile_size=16)  # 地圖物件

        self.level = 0  
        self.load_level(self.level)

        self.screenshske = 0    
        
    # 地圖
    def load_level(self, map_id):     
        self.tilemap.load('data/maps/' + str(map_id) + '.json')
        # self.tilemap.load('map.json')

        self.leaf_spawners = [] # 樹木位置（用來生成葉子粒子）
        for tree in self.tilemap.extract([('large_decor', 2)], keep=True):
            self.leaf_spawners.append(pygame.Rect(4 + tree['pos'][0], 4 + tree['pos'][1], 23, 13))

        self.enemies = []   # 初始化敵人列表，準備放入所有從地圖讀取的敵人
        for spawner in self.tilemap.extract([('spawners', 0), ('spawners', 1)]):
            if spawner['variant'] == 0:
                self.player.pos = spawner['pos']    # 設定主角的位置為這個出生點的位置
                self.player.air_time = 0    # 初始主角自己時間(否則會觸發死亡)
            else:
                self.enemies.append(Enemy(self, spawner['pos'], (8, 15)))   # (8, 15) 是敵人的大小（寬、高）

        self.projectiles = []    # 子彈集合
        self.particles = []  # 粒子集合
        self.sparks = []    # 火花特效

        self.scroll = [0, 0]  # 視窗滾動位置
        self.dead = 0   # 初始化死亡

        
        self.transition = -30  # 用來載入關卡過渡幀
        # 初始化遊戲開始時間
        start_time = pygame.time.get_ticks()

    def run(self):  # 遊戲主循環     
        # 顯示遊戲說明畫面
        draw_text(self.display, "NinjaGame", 48, 160, 20)               # ("文字", 大小, x, y)
        draw_text(self.display, "← → : move left and right", 18, 160, 100)
        draw_text(self.display, "↑ : jump", 18, 160, 130)
        draw_text(self.display, "X : dash or attack", 18, 160, 160)
        draw_text(self.display, "Be careful to kill them all!!", 20, 160, 190)
        draw_text(self.display, "Press any key(or shift) to start the game...", 12, 160, 220)

        # 縮放後顯示到畫面上
        self.screen.blit(pygame.transform.scale(self.display, self.screen.get_size()), (0, 0))
        pygame.display.update()

        # 等待玩家按任意鍵
        waiting = True
        while waiting:
            for event in pygame.event.get():
                if event.type == pygame.QUIT:
                    pygame.quit()
                    sys.exit()
                if event.type == pygame.KEYDOWN:
                    waiting = False
                    
        pygame.mixer.music.load('data/music.wav')
        pygame.mixer.music.set_volume(0.5)
        pygame.mixer.music.play(-1)


        self.sfx['ambience'].play(-1)

        while True:   
            self.display.fill((0, 0, 0, 0))#    透明背景        
            self.display_2.blit(self.assets['background'], (0, 0)) # 清除畫面並繪製背景

            self.screenshake = max(0, self.screenshske - 1) # 控制視窗螢幕

            # 控制地圖讀取轉換邏輯
            if not len(self.enemies):           # 如果目前地圖上沒有敵人（代表過關條件已達成）                
                self.transition += 1            # 啟動轉場動畫，每幀增加 transition 數值               
                if self.transition > 30:        # 當 transition 數值超過 30（代表轉場動畫播放完畢）                  
                    self.level = min(self.level + 1, len(os.listdir('data/maps') )- 1)                   
                    self.load_level(self.level) # 載入新關卡的地圖資料與物件

            if self.transition < 0:             # 如果 transition 小於 0（可能是剛從死亡中復活或從轉場回到正常畫面）                
                self.transition += 1            # 每幀+1，讓畫面回到正常狀態（圓形轉場收縮    
                    
            if self.dead:                   # 如果主角處於死亡狀態（非 0）且沒再滑行              
                self.dead += 1              # 死亡幀數 +1，用來計時死亡動畫或重啟時機
                if self.dead >= 10:             # 當死亡經過 10 幀後（讓死亡動畫有時間播放）                   
                    self.transition = min(30, self.transition + 1)  
                    # 啟動轉場動畫，每幀增加但最多到 30（避免過大）                   
                if self.dead > 40:              # 當死亡超過 40 幀    
                    self.load_level(self.level) # 重新載入當前關卡，等於重生
                    

            # 計算視窗滾動，將玩家保持在視窗中央
            self.scroll[0] += (self.player.rect().centerx - self.display.get_width() / 2 - self.scroll[0]) / 30
            self.scroll[1] += (self.player.rect().centery - self.display.get_height() / 2 - self.scroll[1]) / 30
            render_scroll = (int(self.scroll[0]), int(self.scroll[1]))

            # 粒子生成：樹木區域隨機生成葉子粒子
            for rect in self.leaf_spawners:
                if random.random() * 49999 < rect.width * rect.height:
                    pos = (rect.x + random.random() * rect.width, rect.y + random.random() * rect.height)
                    self.particles.append(Particle(self, 'leaf', pos, velocity=[-0.1, 0.3], frame=random.randint(0, 20)))

            # 更新並渲染雲層
            self.clouds.update()
            self.clouds.render(self.display_2, offset = render_scroll)
            
            # 渲染地圖
            self.tilemap.render(self.display, offset = render_scroll)

            for enemy in self.enemies.copy():
                kill = enemy.update(self.tilemap, (0, 0))
                enemy.render(self.display, offset = render_scroll)
                if kill:
                    self.enemies.remove(enemy)

            if not self.dead:   # 如果沒有死亡
                # 更新並渲染玩家
                self.player.update(self.tilemap, (self.movement[1] - self.movement[0], 0))
                self.player.render(self.display, offset = render_scroll)


            # [[x, y], direction, timer]
            for projectile in self.projectiles.copy():  # 
                projectile[0][0] += projectile[1]
                projectile[2] += 1
                img = self.assets['projectile']
                self.display.blit(img, (projectile[0][0] - img.get_width() / 2 - render_scroll[0], projectile[0][1] - img.get_height() / 2 - render_scroll[1]))

                if self.tilemap.solid_check(projectile[0]):     # 如果子彈碰到地圖中的實體磚塊
                    self.projectiles.remove(projectile)         # 刪除子彈
                    for i in range(4):
                        self.sparks.append(Spark(projectile[0], random.random() - 0.5 + (math.pi if projectile[1] > 0 else 0), 2 + random.random()))
                elif projectile[2] > 360:               # 如果子彈存在時間太久（360 幀，大約 6 秒，如果 60FPS）
                    self.projectiles.remove(projectile)         # 移除子彈（防止無限存在）
                elif abs(self.player.dashing) < 50:             # 如果主角目前不是處於衝刺狀態（衝刺時會短暫無敵）
                    if self.player.rect().collidepoint(projectile[0]):   # 檢查子彈是否打到主角
                        self.projectiles.remove(projectile)     # 刪除子彈
                        self.dead += 1                          # 被擊中時死亡+1
                        self.sfx['hit'].play()                  # 播放受傷音效        
                        self.screenshake = max(16, self.screenshake)    # 張主角被擊中時，視窗抖動
                        for i in range(30):
                            angle = random.random() * math.pi * 2
                            speed = random.random() * 5
                            self.sparks.append(Spark(self.player.rect().center, angle, 2 + random.random()))
                            self.particles.append(Particle(self, 'particle', self.player.rect().center, velocity = [math.cos(angle + math.pi) * speed * 0.5, math.sin(angle + math.pi) * speed * 0.5], frame = random.randint(0, 7)))
            
            
            # 遍歷火花特效，使用 .copy() 是為了避免在迴圈中直接修改原本的列表（否則會導致錯誤)
            for spark in self.sparks.copy():
                # 執行該特效的更新邏輯，並回傳是否應該移除（kill 為 True 表示特效已結束）
                kill = spark.update()
                # 在畫面上渲染火花特效，根據 render_scroll 調整位置
                spark.render(self.display, offset = render_scroll)  
                if kill:
                    self.sparks.remove(spark)   # 如果特效已經結束（回傳 kill=True），就從特效列表中移除，釋放資源

            
            # 運用遮罩增強畫面立體感
            display_mask = pygame.mask.from_surface(self.display)   
            # 將畫面內容轉換成遮罩（mask），可識別哪些像素是非透明的區域
            display_sillhouette = display_mask.to_surface(setcolor = (0, 0, 0, 180), unsetcolor = (0, 0, 0, 0))
            # 將遮罩轉換成一張表面（surface），
            # 已設定像素為半透明黑色（有內容的地方畫成黑色陰影），
            # 未設定像素為完全透明（無內容處不顯示
            for offset in [(-1, 0), (1, 0), (0, -1), (0, 1)]:
                self.display_2.blit(display_sillhouette, offset)
                # 在畫面 display_2 上繪製這個陰影剪影，向四個方向各偏移 1 像素，
                # 組合起來就形成一個「柔和的黑色外框」效果，看起來像輪廓線或陰影    

          
            # 更新並渲染所有粒子
            for particle in self.particles.copy():
                kill = particle.update()                                # 更新粒子
                particle.render(self.display, offset=render_scroll)     # 渲染粒子
                if particle.type == 'leaf':
                    particle.pos[0] += math.sin(particle.animation.frame * 0.035) * 0.3  # 葉子隨動畫飄動
                if kill:                                                # 如果粒子需被移除
                    self.particles.remove(particle)

            # 處理事件（鍵盤輸入、退出等）
            for event in pygame.event.get():
                if event.type == pygame.QUIT:
                    pygame.quit()
                    sys.exit()
                if event.type == pygame.KEYDOWN:
                    if event.key == pygame.K_LEFT:
                        self.movement[0] = True         # 左移
                    if event.key == pygame.K_RIGHT:
                        self.movement[1] = True         # 右移
                    if event.key == pygame.K_UP:
                        if self.player.jump():          # 玩家跳躍
                            self.sfx['jump'].play()     # 播放跳音效
                    if event.key == pygame.K_x:
                        self.player.dash()              # 玩家衝刺
                if event.type == pygame.KEYUP:
                    if event.key == pygame.K_LEFT:
                        self.movement[0] = False        # 停止左移
                    if event.key == pygame.K_RIGHT:
                        self.movement[1] = False        # 停止右移

            # 轉場過度動畫
            if self.transition:   # 如果正在進行轉場（self.transition 有值，不為 0）
                transition_surf = pygame.Surface(self.display.get_size())   # 建立一個與畫面大小相同的 surface 來承載轉場圖形
                pygame.draw.circle(transition_surf, (255, 255, 255), (self.display.get_width() // 2, self.display.get_height() // 2), (30 - abs(self.transition)) * 8)  
                # 在轉場 surface 上以畫面中心為圓心畫一個白色圓形，半徑會隨 transition 值改變
                # transition 越接近 0，圓越大，實現「拉近／擴散」或「收縮」的動畫效果
                transition_surf.set_colorkey((255, 255, 255))   # 將白色設為透明色，讓白色圓形以外的區域不會遮住原畫面
                self.display.blit(transition_surf, (0, 0))       # 將轉場 surface 貼到主畫面上，顯示轉場動畫
            
            self.display_2.blit(self.display, (0, 0))   
            # 將 self.display 的畫面完整覆蓋到 self.display_2 上（對齊左上角）
            # 一般用在套用完剪影或描邊效果後，最後疊上原圖，達成「剪影 + 本體」的完整視覺合成

            # 顯示渲染後的畫面
            screenshake_offset = (random.random() * self.screenshake - self.screenshake / 2, random.random() * self.screenshake - self.screenshake / 2)
            self.screen.blit(pygame.transform.scale(self.display_2, self.screen.get_size()), screenshake_offset)
            pygame.display.update()  # 更新顯示
            self.clock.tick(60)  # 控制遊戲幀率（60 FPS）

Game().run()
