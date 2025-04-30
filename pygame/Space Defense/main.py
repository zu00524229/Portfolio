import pygame
import random
import os


FPS = 60 # 每秒幀數
WIDTH = 500
HEIGHT = 600

BLACK = (0, 0, 0)
WHITE = (255, 255, 255)
GREEN = (0, 255, 0)
RED = (255, 0, 0)
YEALLOW = (255, 255, 0)

# 遊戲初始化 and 創建視窗
pygame.init()
pygame.mixer.init() # 音效初始化
screen = pygame.display.set_mode((WIDTH, HEIGHT))  # 設定視窗大小
pygame.display.set_caption("太空保衛戰!")
clock = pygame.time.Clock()

# 載入圖片(載入圖片前要先初始化，所以要放在pygame.init()後面)
background_img = pygame.image.load(os.path.join("img", "background.png")).convert() # 載入背景圖片
player_img = pygame.image.load(os.path.join("img", "player.png")).convert()
player_mini_img = pygame.transform.scale(player_img, (25, 19))  # 用來表示玩家命數
player_mini_img.set_colorkey(BLACK) # 黑色變成透明
pygame.display.set_icon(player_mini_img)    # 設定視窗圖示
bullet_img = pygame.image.load(os.path.join("img", "bullet.png")).convert()
# rock_img = pygame.image.load(os.path.join("img", "rock.png")).convert()
rock_imgs = []
for i in range(7):
    rock_imgs.append(pygame.image.load(os.path.join("img", f"rock{i}.png")).convert()) # 載入石頭圖片
expl_anim = {}  #設字典存放
expl_anim['lg'] = []    #大爆炸
expl_anim['sm'] = []    #小爆炸
expl_anim['player'] = []    #玩家爆炸
for i in range(9):
    expl_img = pygame.image.load(os.path.join("img", f"expl{i}.png")).convert()
    expl_img.set_colorkey(BLACK)
    expl_anim['lg'].append(pygame.transform.scale(expl_img, (75, 75)))
    expl_anim['sm'].append(pygame.transform.scale(expl_img, (30, 30)))
    player_expl_img = pygame.image.load(os.path.join("img", f"player_expl{i}.png")).convert()
    player_expl_img.set_colorkey(BLACK)
    expl_anim['player'].append(player_expl_img)
power_imgs = {}
power_imgs['shield'] = pygame.image.load(os.path.join("img", "shield.png")).convert()
power_imgs['gun'] = pygame.image.load(os.path.join("img", "gun.png")).convert()

# 載入音效
shoot_sound = pygame.mixer.Sound(os.path.join("sound", "shoot.wav"))    # 載入射擊音效
gun_sound = pygame.mixer.Sound(os.path.join("sound", "pow1.wav"))   # 載入閃電音效
shield_sound = pygame.mixer.Sound(os.path.join("sound", "pow0.wav"))    #載入護盾音效
die_sound = pygame.mixer.Sound(os.path.join("sound", "rumble.ogg")) # 載入死亡音效
expl_sound = [
    pygame.mixer.Sound(os.path.join("sound", "expl0.wav")),
    pygame.mixer.Sound(os.path.join("sound", "expl1.wav"))
]   # 載入爆炸音效
pygame.mixer.music.load(os.path.join("sound", "background.ogg")) # 載入背景音樂
pygame.mixer.music.set_volume(0.7) # 設定音量

# font_name = pygame.font.match_font('arial') # 載入字型
font_name = os.path.join("font.ttf") # 載入中文字型
def draw_text(surf, text, size, x, y):
    font = pygame.font.Font(font_name, size)
    text_surface = font.render(text, True, WHITE)
    text_rect = text_surface.get_rect()
    text_rect.centerx = x
    text_rect.top = y
    surf.blit(text_surface,text_rect)   # 畫出文字

# 生成石頭
def new_rock():
    r = Rock()      # 產生石頭
    all_sprites.add(r)  # 加入所有
    rocks.add(r)    # 加入石頭群組

# 繪製生命條
def draw_health(surf, hp, x, y):
    if hp < 0:  
        hp = 0
    BAR_LENGTH = 100    # 長度
    BAR_HEIGHT = 10     # 高度
    fill = (hp/100)*BAR_LENGTH      # 填滿的長度
    outline_rect = pygame.Rect(x, y, BAR_LENGTH, BAR_HEIGHT) # 外框
    fill_rect = pygame.Rect(x, y, fill, BAR_HEIGHT) # 填滿的長方形
    pygame.draw.rect(surf, GREEN, fill_rect) # 填滿的長方形
    pygame.draw.rect(surf, WHITE, outline_rect, 2) # 畫出外框

def draw_lives(surf, lives, img, x, y):
    for i in range(lives):
        img_rect = img.get_rect()
        img_rect.x = x + 32 * i # 設定生命數圖片間隔
        img_rect.y = y
        surf.blit(img, img_rect)

def draw_init():
    screen.blit(background_img, (0, 0)) # 畫出背景圖片
    draw_text(screen, '太空保衛戰!', 64, WIDTH/2, HEIGHT/4) # 畫出標題
    draw_text(screen, 'A D 移動飛船 空白鍵發射子彈', 22, WIDTH/2, HEIGHT/2) # 畫出提示文字
    draw_text(screen, '任意鍵開始遊戲', 18, WIDTH/2, HEIGHT*3/4)
    pygame.display.update() # 更新畫面
    waiting = True
    while waiting:
        clock.tick(FPS)  
        # 取得輸入
        for event in pygame.event.get():    
            if event.type == pygame.QUIT:
                pygame.quit()
                return True
            elif event.type == pygame.KEYUP:  
               waiting = False
               return False
# 飛船
class Player(pygame.sprite.Sprite):
    def __init__(self):
        pygame.sprite.Sprite.__init__(self)
        self.image = pygame.transform.scale(player_img, (50, 38))
        self.image.set_colorkey(BLACK) # 代表把黑色變成透明
        self.rect = self.image.get_rect()
        self.recdius = 20 # 碰撞檢測的半徑
        # pygame.draw.circle(self.image, RED, self.rect.center, self.recdius)
        self.rect.centerx = WIDTH/2 # 設定玩家初始位置
        self.rect.bottom = HEIGHT - 10 # 設定玩家底部座標
        self.speedx = 8 # X方向速度
        self.health = 100 # 玩家生命值
        self.lives = 3 # 玩家幾條命
        self.hidden = False # 玩家是否隱藏
        self.hide_time = 0  # 隱藏時間
        self.gun = 1 # 玩家槍等級
        self.gun_time = 0   # 吃到閃電的時間

    def update(self):
        now = pygame.time.get_ticks()
        # 如果子彈等級大於1且經過5秒鐘後，則槍等級減1
        if self.gun > 1 and now - self.gun_time > 5000:
            self.gun -= 1
            self.gun_time = now

        # 如果玩家隱藏後且經過1秒鐘後，則顯示玩家
        if self.hidden and now - self.hide_time > 1000:
            self.hidden = False
            self.rect.centerx = WIDTH/2 # 設定玩家初始位置
            self.rect.bottom = HEIGHT - 10 # 設定玩家底部座標


        key_pressed = pygame.key.get_pressed()
        if key_pressed[pygame.K_d]:
            self.rect.x += self.speedx
        if key_pressed[pygame.K_a]:
            self.rect.x -= self.speedx

        # 限制玩家出邊界
        if self.rect.right > WIDTH:
            self.rect.right = WIDTH
        if self.rect.left < 0:
            self.rect.left = 0
    
    def shoot(self):
        if not(self.hidden):    # 如果飛機沒有隱藏中
            if self.gun == 1:   # 如果槍等級為1
                bullet = Bullet(self.rect.centerx, self.rect.top)   # 產生子彈
                all_sprites.add(bullet)
                bullets.add(bullet) # 將子彈加入子彈群組
                shoot_sound.play()
            elif self.gun >= 2:
                bullet1 = Bullet(self.rect.left, self.rect.centery)   
                bullet2 = Bullet(self.rect.right, self.rect.centery)   
                all_sprites.add(bullet1)
                all_sprites.add(bullet2)
                bullets.add(bullet1) # 將子彈加入子彈群組
                bullets.add(bullet2)
                shoot_sound.play()

    def hide(self):
        self.hidden = True
        self.hide_time = pygame.time.get_ticks() 
        self.rect.center = (WIDTH/2, HEIGHT+500)   

    def  gunup(self):
        self.gun += 1
        self.gun_time = pygame.time.get_ticks() # 記錄吃到閃電的時間

# 石頭
class Rock(pygame.sprite.Sprite):
    def __init__(self):
        pygame.sprite.Sprite.__init__(self)
        self.image_ori = random.choice(rock_imgs) # 存放未失幀圖片
        self.image_ori.set_colorkey(BLACK) # 把黑色變成透明
        self.image = self.image_ori.copy() # 存放失幀過的圖片
        self.rect = self.image.get_rect()
        self.radius = int(self.rect.width * 0.85 / 2)
        # pygame.draw.circle(self.image, RED, self.rect.center, sdelf.recdius)
        self.rect.x = random.randrange(0, WIDTH - self.rect.width)
        self.rect.y = random.randrange(-180, -100)
        self.speedy = random.randrange(2, 5) # 石頭落下速度
        self.speedx = random.randrange (-3, 3) # 石頭橫向速度
        self.total_degree = 0
        self.rot_degree =  random.randrange(-3, 3) # 旋轉角度

    def rotate(self):
        self.total_degree += self.rot_degree
        self.total_degree = self.total_degree % 360 # 確保不會超過360度
        self.image = pygame.transform.rotate(self.image_ori, self.total_degree)
        center = self.rect.center
        self.rect = self.image.get_rect()
        self.rect.center = center


    def update(self):
        self.rotate()   # 旋轉
        self.rect.y += self.speedy
        self.rect.x += self.speedx
        # 超出底部邊界 or 超出左邊界 or 超出右邊界
        if self.rect.top > HEIGHT or self.rect.left > WIDTH or self.rect.right < 0:
            self.rect.x = random.randrange(0, WIDTH - self.rect.width)
            self.rect.y = random.randrange(-100, -40)
            self.speedy = random.randrange(2, 10) 
            self.speedx = random.randrange(-3, 3) 

# 子彈
class Bullet(pygame.sprite.Sprite):
    def __init__(self, x, y):
        pygame.sprite.Sprite.__init__(self)
        self.image = bullet_img
        self.image.set_colorkey(BLACK) # 把黑色變成透明
        self.rect = self.image.get_rect()
        self.rect.centerx = x
        self.rect.bottom = y
        self.speedy = -10 # 子彈上升速度 


    def update(self):
        self.rect.y += self.speedy
        if self.rect.bottom < 0:    # 如果子彈超出上邊界
            self.kill() # 刪除子彈

class Explosion(pygame.sprite.Sprite):
    def __init__(self, center, size):
        pygame.sprite.Sprite.__init__(self)
        self.size = size
        self.image = expl_anim[self.size][0]
        self.rect = self.image.get_rect()
        self.rect.center = center
        self.frame = 0  
        self.last_update = pygame.time.get_ticks()  ## 計算時間
        self.frame_rate = 50  # 爆炸動畫速度

    def update(self):
        now = pygame.time.get_ticks()
        if now - self.last_update > self.frame_rate:
            self.last_update = now
            self.frame += 1
            if self.frame == len(expl_anim[self.size]):
                self.kill()
            else:
                self.image = expl_anim[self.size][self.frame]
                center = self.rect.center
                self.rect = self.image.get_rect()
                self.rect.center = center   
                
# 寶物                
class Power(pygame.sprite.Sprite):
    def __init__(self, center):
        pygame.sprite.Sprite.__init__(self)
        self.type = random.choice(['shield', 'gun']) # 隨機掉落寶物
        self.image = power_imgs[self.type]
        self.image.set_colorkey(BLACK) # 把黑色變成透明
        self.rect = self.image.get_rect()
        self.rect.center = center
        self.speedy = 3 # 寶物下降速度


    def update(self):
        self.rect.y += self.speedy
        if self.rect.top > HEIGHT:    # 如果大於視窗高度
            self.kill() # 刪除寶物


all_sprites = pygame.sprite.Group() 
rocks = pygame.sprite.Group()   # 石頭群組
bullets = pygame.sprite.Group() # 子彈群組
powers = pygame.sprite.Group() # 寶物群組
player = Player()
all_sprites.add(player)
for i in range(8):
    # r = Rock()
    # all_sprites.add(r)  #
    # rocks.add(r)    # 加入石頭群組
    new_rock()
score = 0
pygame.mixer.music.play(-1) # 播放背景音樂，-1代表無限循環

# 遊戲迴圈
show_init = True
running = True
while running:
    if show_init:
        colse = draw_init()
        if colse:
            break
        show_init = False
        all_sprites = pygame.sprite.Group() 
        rocks = pygame.sprite.Group()   # 石頭群組
        bullets = pygame.sprite.Group() # 子彈群組
        powers = pygame.sprite.Group() # 寶物群組
        player = Player()
        all_sprites.add(player)
        for i in range(8):
            new_rock()
        score = 0

    clock.tick(FPS)  # 在1秒鐘內最多執行次數
    # 取得輸入
    for event in pygame.event.get():    # python.event.get()回傳發生所有事件
        if event.type == pygame.QUIT:
            running = False
        elif event.type == pygame.KEYDOWN:  # 如果按下鍵盤
            if event.key == pygame.K_SPACE: # 按下空白鍵d
                player.shoot()  # 發射子彈

    # 更新遊戲
    all_sprites.update()
    # 判斷石頭 子彈碰撞
    hits = pygame.sprite.groupcollide(rocks, bullets, True, True) 
    
    for hit in hits:    # 碰撞後
        random.choice(expl_sound).play()
        score += hit.radius
        expl = Explosion(hit.rect.center, 'lg') 
        all_sprites.add(expl)
        if random.random() > 0.9: # 設定掉寶率(10%)
            pow = Power(hit.rect.center)
            all_sprites.add(pow)
            powers.add(pow)
        # r = Rock()      # 產生石頭
        # all_sprites.add(r)  # 加入所有
        # rocks.add(r)    # 加入石頭群組
        new_rock()

    # 判斷石頭 飛船碰撞
    hits = pygame.sprite.spritecollide(player, rocks, True, pygame.sprite.collide_circle)  
    # 碰撞檢測，pygame.sprite.collide_circle改成圓形碰撞檢體
    for hit in hits:
        new_rock()
        player.health -= hit.radius    # 石頭傷害
        expl = Explosion(hit.rect.center, 'sm') 
        all_sprites.add(expl)
        if player.health <= 0:
            death_expl = Explosion(player.rect.center, 'player')
            all_sprites.add(death_expl)    # 死亡爆炸動畫
            die_sound.play()    # 播放死亡音效
            player.lives -= 1
            player.health = 100
            player.hide()
            # running = False
    # 判斷寶物 飛船碰撞
    hits = pygame.sprite.spritecollide(player, powers, True)  
    for hit in hits:
        if hit.type == 'shield':    # 如果是護盾
            player.health += 20 # 玩家生命值加20
            if player.health > 100:
                player.health = 100
            shield_sound.play()
        elif hit.type == 'gun':   # 如果是閃電
            player.gunup()
            gun_sound.play()

    if player.lives == 0 and not(death_expl.alive()):
        show_init = True

    # 畫面顯示
    screen.fill((BLACK))    # 背景顏色 
    screen.blit(background_img, (0, 0)) # 畫出背景圖片
    all_sprites.draw(screen)  # 畫出所有
    draw_text(screen, str(score), 18, WIDTH/2, 10) # 畫出分數 
    draw_health(screen, player.health, 10, 15) # 畫出生命條
    draw_lives(screen, player.lives, player_mini_img, WIDTH - 100, 15) # 畫出生命數
    pygame.display.update()  # 更新畫面

pygame.quit()