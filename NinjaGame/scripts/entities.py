import math
import random

import pygame

from scripts.particle import Particle
from scripts.spark import Spark

class PhysicsEntity:    # 物理
    def __init__(self, game, e_type, pos, size):
        self.game = game              # 傳入的主遊戲物件（用來取得地圖、音效、畫面等全域資源）
        self.type = e_type            # 實體類型（例如 "player" 玩家 或 "enemy" 敵人）
        self.pos = list(pos)          # 實體位置 [x, y]（轉成 list 方便直接修改座標）
        self.size = size              # 實體大小 [寬, 高]
        self.velocity = [0, 0]        # 初始速度 [x軸速度, y軸速度]

        # 碰撞方向紀錄（每次更新碰撞時都會覆蓋）
        self.collisions = {'up': False, 'down': False, 'right': False, 'left': False}

        self.action = ''              # 當前動畫動作（先設為空字串）
        self.anim_offset = (-3, -3)   # 動畫偏移（微調位置對齊）
        self.flip = False             # 是否左右翻轉（面對方向，False 代表朝右）

        self.set_action('idle')       # 預設動作為待機（idle）

        self.last_movement = [0, 0]   # 上一幀的移動向量（用於判斷牆跳、轉向等）

    def rect(self): # 回傳 pygame.Rect 物件，用來做碰撞偵測（位置 + 尺寸）
        return pygame.Rect(self.pos[0], self.pos[1], self.size[0], self.size[1])
    
    def set_action(self, action):
        if action != self.action:
            self.action = action
            self.animation = self.game.assets[self.type + '/' + self.action].copy()

    def update(self, tilemap, movement=(0, 0)): 
        # 每次更新都重置碰撞狀態
        self.collisions = {'up': False, 'down': False, 'right': False, 'left': False}
        # 加總本次移動量 = 傳入移動值 + 目前速度（如重力）
        frame_movement = (movement[0] + self.velocity[0], movement[1] + self.velocity[1]) # 速度

        # === 水平方向（X 軸）移動與碰撞 ===
        self.pos[0] += frame_movement[0]           # 根據移動速度調整水平位置
        entity_rect = self.rect()                  # 取得角色的新矩形框
        for rect in tilemap.physics_rects_around(self.pos):  # 取得附近的可碰撞方塊
            if entity_rect.colliderect(rect):      # 如果角色與某個方塊有重疊
                if frame_movement[0] > 0:          # 向右移動的話
                    entity_rect.right = rect.left  # 將角色的右邊對齊方塊的左邊（防止穿透）
                    self.collisions['right'] = True
                if frame_movement[0] < 0:          # 向左移動的話
                    entity_rect.left = rect.right  # 將角色的左邊對齊方塊的右邊
                    self.collisions['left'] = True
                self.pos[0] = entity_rect.x        # 修正實際的位置

        # === 垂直方向（Y 軸）移動與碰撞 ===
        self.pos[1] += frame_movement[1]           # 根據移動速度調整垂直位置
        entity_rect = self.rect()
        for rect in tilemap.physics_rects_around(self.pos):
            if entity_rect.colliderect(rect):
                if frame_movement[1] > 0:          # 往下掉落的話
                    entity_rect.bottom = rect.top  # 角色底部貼齊地板
                    self.collisions['down'] = True
                if frame_movement[1] < 0:          # 往上跳的話
                    entity_rect.top = rect.bottom  # 角色頂部貼齊天花板
                    self.collisions['up'] = True
                self.pos[1] = entity_rect.y        # 修正位置

        # 轉向（根據移動方向調整角色面對的方向）
        if movement[0] > 0:     
            self.flip = False           # 向右移動時，角色不翻轉（朝右）
        if movement[0] < 0:
            self.flip = True            # 向左移動時，角色翻轉（朝左）

        self.last_movement = movement                   # 記錄上一幀的移動方向（用於牆跳等判斷）

        # 垂直速度變化（模擬重力）
        self.velocity[1] = min(5, self.velocity[1] + 0.1)       # y軸速度加0.1（最大限制為5）
       
        if self.collisions['down'] or self.collisions['up']:    # 如果角色腳底或頭部有碰撞，垂直速度設為0
            self.velocity[1] = 0

        self.animation.update()                     # 更新動畫（根據當前動作播放對應的動畫幀）

    def render(self, surf, offset = (0, 0)):        # 把圖片畫到畫面上，位置要減去鏡頭的偏移
        surf.blit(pygame.transform.flip(self.animation.img(), self.flip, False), (self.pos[0] - offset[0] + self.anim_offset[0], self.pos[1] - offset[1] + self.anim_offset[1]))

# 敵人AI
class Enemy(PhysicsEntity): # 繼承 PhysicsEntity 類別（有重力與碰撞功能）
    def __init__ (self, game, pos, size):
        super().__init__(game, 'enemy', pos, size)

        self.walking = 0    # 控制持續走路的時間，0 表示暫時不動

    def update(self, tilemap, movement = (0, 0)):       
        if self.walking:    # 如果正在行走中
            if tilemap.solid_check((self.rect().centerx + (-7 if self.flip else 7), self.pos[1] + 23)): 
                # 檢查腳下是否有實體磚塊（防止掉下懸崖）               
                if self.collisions['right'] or self.collisions['left']: # 如果碰到牆壁，就反轉方向
                    self.flip = not self.flip   # 前方沒有地板，改變方向（防止跌落）
                else:                           # 否則依照面向方向前進                   
                    movement = (movement[0] - 0.5 if self.flip else 0.5, movement[1])
            else:              
                self.flip = not self.flip                       # 前方沒有地板，改變方向（防止跌落）          
            self.walking = max(0, self.walking - 1)      
            if not self.walking:                              # 如果沒有走動
                dis = (self.game.player.pos[0] - self.pos[0], self.game.player.pos[1] - self.pos[1])
                if (abs(dis[1]) < 16):                          # 如果面向右邊，且玩家在右邊
                    if (self.flip and dis[0] < 0):              #  True面向左且距離小於dis
                        self.game.sfx['shoot'].play()           # 播放射擊音效
                        self.game.projectiles.append([[self.rect().centerx - 7, self.rect().centery], -1.5, 0])
                        for i in range(4):
                            self.game.sparks.append(Spark(self.game.projectiles[-1][0], random.random() - 0.5 + math.pi, 2 + random.random()))
                    if (not self.flip and dis[0] > 0):          # 如果面向右邊，且玩家在右邊
                        self.game.projectiles.append([[self.rect().centerx + 7, self.rect().centery], 1.5, 0])
                        for i in range(4):
                            self.game.sparks.append(Spark(self.game.projectiles[-1][0], random.random() - 0.5, 2 + random.random()))
        elif random.random() < 0.01:                            # 有機率開始新一輪走路（1% 機率觸發）
            self.walking = random.randint(30, 120)              # 隨機走 30~120 次 update
       
        super().update(tilemap, movement = movement)            # 呼叫父類別更新，碰撞與重力處理
        
        if movement[0] != 0:        # 根據是否在移動切換動畫
            self.set_action('run')  # 跑
        else:
            self.set_action('idle') # 待機

        # 如果主角正在衝刺（衝刺距離或速度達到一定程度）
        if abs(self.game.player.dashing) >= 50:            
            if self.rect().colliderect(self.game.player.rect()):            # 檢查敵人和主角是否碰撞（矩形範圍是否重疊）
                self.game.screenshake = max(16, self.game.screenshake)      # 敵人與主角碰撞則螢幕抖動
                self.game.sfx['hit'].play()                                 # 播放受傷音效
                for i in range(30):
                            angle = random.random() * math.pi * 2
                            speed = random.random() * 5
                            self.game.sparks.append(Spark(self.rect().center, angle, 2 + random.random()))
                            self.game.particles.append(Particle(self.game, 'particle', self.rect().center, velocity = [math.cos(angle + math.pi) * speed * 0.5, math.sin(angle + math.pi) * speed * 0.5], frame = random.randint(0, 7)))
                self.game.sparks.append(Spark(self.rect().center, 0, 5 + random.random()))
                self.game.sparks.append(Spark(self.rect().center, math.pi, 5 + random.random()))
                return True     # 回傳 True，代表有發生碰撞

    def render(self, surf, offset = (0, 0)):
        super().render(surf, offset = offset)

        if self.flip:
            surf.blit(pygame.transform.flip(self.game.assets['gun'], True, False), (self.rect().centerx - 4 - self.game.assets['gun'].get_width() - offset[0], self.rect().centery - offset[1]))
        else:
            surf.blit(self.game.assets['gun'], (self.rect().centerx + 4 - offset[0], self.rect().centery - offset[1]))

# 主角控制邏輯
class Player(PhysicsEntity):
    def __init__(self, game, pos, size):
        super().__init__(game, 'player', pos, size)
        self.air_time = 0                               # 飛行時間初始為 0，用來計算角色在空中的時間
        self.jumps = 1                                  # 角色的跳躍次數初始為 1
        self.wall_slide = False                         # 初始時無牆壁滑行（False）
        self.dashing = 0                                # 衝刺變數初始為 0，表示衝刺的初始狀態，可能用來處理衝刺時間與冷卻
        

    def update(self, tilemap, movement = (0, 0)):
        super().update(tilemap, movement = movement)

        self.air_time += 1

        if self.air_time > 120 and not self.wall_slide: # 如果角色在空中的時間超過2秒且沒在牆上滑行
            if not self.game.dead:                      # 如果角色目前還沒死亡（避免重複執行死亡相關動作）
                self.game.screenshake = max(16, self.game.screenshake)    # 敵人與主角碰撞則螢幕抖動
            if not self.wall_slide:
                self.game.dead += 1                     # 如果掉落間大於2秒則角色死亡
            

        if self.collisions['down']:
            self.air_time = 0
            self.jumps = 1

        # 瞪牆跳
        self.wall_slide = False                             # 滑動初始false
        if (self.collisions['right'] or self.collisions['left']) and self.air_time > 4:     # 如果撞到任一側牆壁，則在空中>4幀
            self.wall_slide = True                          # 啟動牆上滑動
            self.velocity[1] = min(self.velocity[1], 0.5)   # 向下滑動速度限制0.5(最小值)

############################################## BUG 整修(check)######################################################
            #在 wall_slide 狀態時「凍結」 air_time 在 50 以內，以防放開貼牆時會立即死亡
            self.air_time = min(self.air_time, 50)
            self.air_time -= 0.5  # 持續降低幀數
######################################################################################################################
        
            if self.collisions['right']:                # 如果碰到右邊牆
                self.flip = False                       # 面向右邊（不轉向）
            else:                                       # 否則就是碰到左邊牆
                self.flip = True                        # 面向左邊（轉向）
            self.set_action('wall_slide')               # 播放牆滑動畫


        # print(self.air_time)  # 檢查當前幀數

        if not self.wall_slide:     # 如果沒有滑動時
            if self.air_time > 4:   # >4幀
                self.set_action('jump')     # 則播放跳躍動畫
            elif movement[0] != 0:          # 移動x軸不等於0時(如果有水平方向移動)
                self.set_action('run')      # 播放跑動畫
            else:               
                self.set_action('idle')     # 否則播放待機動畫

        if abs(self.dashing) in {60, 50}:   # 在衝刺起點或終點時
            for i in range(20):             # 將隨機創建20個粒子
                angle = random.random() * math.pi * 2   # 產生一個隨機的角度 (0 ~ 2π)，代表粒子發射的方向是圓形任意方向（360度）
                speed = random.random() * 0.5 + 0.5     # 產生一個速度值，範圍為 0.5 ~ 1.0（讓粒子速度不要太慢）
                pvelocity = [math.cos(angle) * speed, math.sin(angle) * speed]  # 使用三角函數將「角度」與「速度」轉換成 x、y 方向的速度向量
                self.game.particles.append(Particle(self.game, 'particle', self.rect().center, velocity = pvelocity, frame = random.randint(0, 7)))
                # 傳入主物件, 粒子類型, 粒子初始位置=當前角色中心, 隨機選擇一個動畫幀0~7

        # 衝刺(攻擊)
        if self.dashing > 0:                            # 如果衝刺值大於0（向右衝刺中）
            self.dashing = max(0, self.dashing - 1)     # 每幀衝刺值減1（最小不能低於0）

        if self.dashing < 0:                            # 如果衝刺值小於0（向左衝刺中）
            self.dashing = min(0, self.dashing + 1)     # 每幀衝刺值加1（最大不能高於0）
      
        if abs(self.dashing) > 50:                      # 如果衝刺值絕對值大於50，則進行高速水平移動(冷卻時間50/60 約0.83秒)
            self.velocity[0] = abs(self.dashing) / self.dashing * 8  # 計算方向：正值→向右（速度8）、負值→向左（速度-8）abs:絕對值           
            if abs(self.dashing) == 51:                 # 後10幀來準備緩衝，(讓衝刺更有節奏感)
                self.velocity[0] *= 0.1                 # 衝刺結束後的緩衝滑行效果(手感處理)
            pvelocity = [abs(self.dashing) / self.dashing * random.random() * 3, 0]
            self.game.particles.append(Particle(self.game, 'particle', self.rect().center, velocity = pvelocity, frame = random.randint(0, 7)))
        

        # 牆壁摩擦力
        if self.velocity[0] > 0:                        # 如果向右移動（x 軸速度 > 0）
            self.velocity[0] = max(self.velocity[0] - 0.1, 0)  # 向右減速，每次減少 0.1，最小不低於 0
        elif self.velocity[0] < 0:                      # 如果向左移動（x 軸速度 < 0）
            self.velocity[0] = min(self.velocity[0] + 0.1, 0)  # 向左減速，每次增加 0.1，最大不超過 0

    def render(self, surf, offset = (0, 0)):
        if abs(self.dashing) <= 50:                     # 如果再衝刺前10幀
            super().render(surf, offset = offset)

    # 跳躍邏輯
    def jump(self):
        if self.wall_slide:                 # 如果角色正在滑牆
            if self.flip and self.last_movement[0] < 0:  # 如果角色面朝左且上一幀往左移動（貼著右牆）
                self.velocity[0] = 3.5      # 向右跳，給x軸速度3.5
                self.velocity[1] = -2.5     # 給y軸向上的跳躍速度（負值代表向上）
                self.air_time = 5           # 設定空中時間為5幀
                self.jumps = max(0, self.jumps - 1)  # 減少一次跳躍次數（至少為0）
                return True                 # 成功牆跳，回傳 True
            elif not self.flip and self.last_movement[0] > 0:  # 如果角色面朝右且上一幀往右移動（貼著左牆）
                self.velocity[0] = -3.5     # 向左跳，給x軸速度-3.5
                self.velocity[1] = -2.5     # 給y軸向上的跳躍速度
                self.air_time = 5
                self.jumps = max(0, self.jumps - 1)
                return True                 # 成功牆跳，回傳 True
            
        elif self.jumps:            # 如果還有跳躍次數（不是滑牆跳）
            self.velocity[1] = -3   # 給一個普通跳躍的y軸速度（向上跳較高）
            self.jumps -= 1         # 減少跳躍次數
            self.air_time = 5       # 空中時間設為5幀
            return True             # 回傳成功原地跳
        
    def dash(self):
        if not self.dashing:                # 如果沒有滑行
            self.game.sfx['dash'].play()    # 播放衝刺音效
            if self.flip:                   # 如果面朝左
                self.dashing = -60  
            else:
                self.dashing = 60
