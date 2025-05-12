import sys

import pygame

from scripts.utils import load_images
from scripts.tilemap import Tilemap

RENDER_SCALE = 2.0

class Editor:
    def __init__(self):
        pygame.init()  # 初始化pygame，準備創建遊戲視窗
        pygame.display.set_caption('editor')  # 設置視窗標題
        self.screen = pygame.display.set_mode((640, 480))  # 設置顯示視窗大小
        self.display = pygame.Surface((320, 240))  # 創建一個內部顯示表面，使用較小的畫布進行渲染
        
        self.clock = pygame.time.Clock()  # 設置遊戲時鐘，用於控制遊戲更新頻率
        
        # 載入各種地圖磚塊的圖片資源
        self.assets = {
            'decor': load_images('tiles/decor'),  # 裝飾類型的磚塊
            'grass': load_images('tiles/grass'),  # 草地類型的磚塊
            'large_decor': load_images('tiles/large_decor'),  # 大型裝飾類型的磚塊
            'stone': load_images('tiles/stone'),  # 石頭類型的磚塊
            'spawners': load_images('tiles/spawners'),  # 人物
        }
        
        self.movement = [False, False, False, False]  # 用於追蹤是否有按下方向鍵（A, D, W, S）
        
        self.tilemap = Tilemap(self, tile_size=16)  # 創建一個Tilemap物件，並設置每個瓦片的大小
        
        try:
            self.tilemap.load('map.json')  # 嘗試加載已保存的地圖文件
        except FileNotFoundError:
            pass  # 如果文件不存在，則忽略錯誤
        
        self.scroll = [0, 0]  # 設置初始滾動位置為(0, 0)
        
        self.tile_list = list(self.assets)  # 取得所有地圖塊類型的列表
        self.tile_group = 0  # 記錄當前選中的地圖塊類型
        self.tile_variant = 0  # 記錄當前選中的地圖塊變體
        
        self.clicking = False  # 判斷是否在按左鍵
        self.right_clicking = False  # 判斷是否在按右鍵
        self.shift = False  # 判斷是否按住shift鍵
        self.ongrid = True  # 是否啟用網格模式，默認為True

        
    def run(self):
        while True:
            self.display.fill((0, 0, 0))  # 每次更新畫面前先清除畫布
            
            # 計算滾動
            self.scroll[0] += (self.movement[1] - self.movement[0]) * 2  # 向右滾動
            self.scroll[1] += (self.movement[3] - self.movement[2]) * 2  # 向下滾動
            render_scroll = (int(self.scroll[0]), int(self.scroll[1]))  # 滾動的像素位置
            
            # 渲染地圖
            self.tilemap.render(self.display, offset=render_scroll)
            
            # 根據當前選中的地圖塊生成一個半透明的影像，用來顯示放置的預覽
            current_tile_img = self.assets[self.tile_list[self.tile_group]][self.tile_variant].copy()
            current_tile_img.set_alpha(100)  # 設置預覽圖的透明度為100
            
            # 取得鼠標位置
            mpos = pygame.mouse.get_pos()
            mpos = (mpos[0] / RENDER_SCALE, mpos[1] / RENDER_SCALE)  # 根據縮放比例調整
            tile_pos = (int((mpos[0] + self.scroll[0]) // self.tilemap.tile_size), int((mpos[1] + self.scroll[1]) // self.tilemap.tile_size))  # 計算所點擊的格子位置
            
            # 顯示選中的地圖塊
            if self.ongrid:
                self.display.blit(current_tile_img, (tile_pos[0] * self.tilemap.tile_size - self.scroll[0], tile_pos[1] * self.tilemap.tile_size - self.scroll[1]))
            else:
                self.display.blit(current_tile_img, mpos)  # 如果不在網格上，則顯示在鼠標位置
            
            # 左鍵點擊放置磚塊
            if self.clicking and self.ongrid:
                self.tilemap.tilemap[str(tile_pos[0]) + ';' + str(tile_pos[1])] = {'type': self.tile_list[self.tile_group], 'variant': self.tile_variant, 'pos': tile_pos}
            
            # 右鍵刪除磚塊
            if self.right_clicking:
                tile_loc = str(tile_pos[0]) + ';' + str(tile_pos[1])
                if tile_loc in self.tilemap.tilemap:
                    del self.tilemap.tilemap[tile_loc]  # 刪除該位置的磚塊
                for tile in self.tilemap.offgrid_tiles.copy():  # 如果不是在網格內，則刪除不在網格內的磚塊
                    tile_img = self.assets[tile['type']][tile['variant']]
                    tile_r = pygame.Rect(tile['pos'][0] - self.scroll[0], tile['pos'][1] - self.scroll[1], tile_img.get_width(), tile_img.get_height())
                    if tile_r.collidepoint(mpos):
                        self.tilemap.offgrid_tiles.remove(tile)
            
            # 顯示當前選中的地圖塊圖片
            self.display.blit(current_tile_img, (5, 5))
            
            # 處理事件（鼠標、鍵盤）
            for event in pygame.event.get():
                if event.type == pygame.QUIT:  # 點擊關閉視窗
                    pygame.quit()
                    sys.exit()
                    
                if event.type == pygame.MOUSEBUTTONDOWN:
                    if event.button == 1:  # 左鍵點擊
                        self.clicking = True
                        if not self.ongrid:
                            # 若不在網格上，則加入"不在網格"的磚塊
                            self.tilemap.offgrid_tiles.append({'type': self.tile_list[self.tile_group], 'variant': self.tile_variant, 'pos': (mpos[0] + self.scroll[0], mpos[1] + self.scroll[1])})
                    if event.button == 3:  # 右鍵點擊
                        self.right_clicking = True
                    if self.shift:  # 按下shift鍵時，滾動切換變體
                        if event.button == 4:
                            self.tile_variant = (self.tile_variant - 1) % len(self.assets[self.tile_list[self.tile_group]])  # 滾動向上切換變體
                        if event.button == 5:
                            self.tile_variant = (self.tile_variant + 1) % len(self.assets[self.tile_list[self.tile_group]])  # 滾動向下切換變體
                    else:  # 未按shift時，滾動切換瓦片類型
                        if event.button == 4:
                            self.tile_group = (self.tile_group - 1) % len(self.tile_list)  # 上滾切換到前一類型
                            self.tile_variant = 0
                        if event.button == 5:
                            self.tile_group = (self.tile_group + 1) % len(self.tile_list)  # 下滾切換到下一類型
                            self.tile_variant = 0
                if event.type == pygame.MOUSEBUTTONUP:
                    if event.button == 1:  # 左鍵松開
                        self.clicking = False
                    if event.button == 3:  # 右鍵松開
                        self.right_clicking = False
                
                if event.type == pygame.KEYDOWN:
                    if event.key == pygame.K_a:  # A鍵向左滾動
                        self.movement[0] = True
                    if event.key == pygame.K_d:  # D鍵向右滾動
                        self.movement[1] = True
                    if event.key == pygame.K_w:  # W鍵向上滾動
                        self.movement[2] = True
                    if event.key == pygame.K_s:  # S鍵向下滾動
                        self.movement[3] = True
                    if event.key == pygame.K_g:  # G鍵開關網格模式
                        self.ongrid = not self.ongrid
                    if event.key == pygame.K_t:  # T鍵進行自動瓦片生成
                        self.tilemap.autotile()
                    if event.key == pygame.K_o:  # O鍵保存地圖
                        self.tilemap.save('map.json')
                    if event.key == pygame.K_LSHIFT:  # Shift鍵
                        self.shift = True
                if event.type == pygame.KEYUP:
                    if event.key == pygame.K_a:  # A鍵松開
                        self.movement[0] = False
                    if event.key == pygame.K_d:  # D鍵松開
                        self.movement[1] = False
                    if event.key == pygame.K_w:  # W鍵松開
                        self.movement[2] = False
                    if event.key == pygame.K_s:  # S鍵松開
                        self.movement[3] = False
                    if event.key == pygame.K_LSHIFT:  # Shift鍵松開
                        self.shift = False
            
            # 更新顯示畫面
            self.screen.blit(pygame.transform.scale(self.display, self.screen.get_size()), (0, 0))
            pygame.display.update()
            self.clock.tick(60)  # 設置每秒更新頻率為60


Editor().run()