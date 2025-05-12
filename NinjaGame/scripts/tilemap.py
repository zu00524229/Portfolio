import json

import pygame

AUTOTILE_MAP = {
    tuple(sorted([(1, 0), (0, 1)])): 0,
    tuple(sorted([(1, 0), (0, 1), (-1, 0)])): 1,
    tuple(sorted([(-1, 0), (0, 1)])): 2, 
    tuple(sorted([(-1, 0), (0, -1), (0, 1)])): 3,
    tuple(sorted([(-1, 0), (0, -1)])): 4,
    tuple(sorted([(-1, 0), (0, -1), (1, 0)])): 5,
    tuple(sorted([(1, 0), (0, -1)])): 6,
    tuple(sorted([(1, 0), (0, -1), (0, 1)])): 7,
    tuple(sorted([(1, 0), (-1, 0), (0, 1), (0, -1)])): 8,
}

NEIGHBOR_OFFSETS = [(-1, 0), (-1, -1), (0, -1), (1, -1), (1, 0), (0, 0), (-1, 1), (0, 1), (1, 1)]
PHYSICS_TILES = {'grass', 'stone'}
AUTOTILE_TYPES = {'grass', 'stone'}

# 主地圖
class Tilemap:
    def __init__(self, game, tile_size = 16):
        self.game = game                 # 傳入的主遊戲物件（方便取得共用資源）
        self.tile_size = tile_size       # 每個磚塊的尺寸（像素大小）
        self.tilemap = {}                # 儲存有格子的磚塊（用字典 key = "x;y"）
        self.offgrid_tiles = []          # 非對齊格子的磚塊（例如背景裝飾用）

    # 粒子特效
    def extract(self, id_pairs, keep=False):
        matches = []
        for tile in self.offgrid_tiles.copy():
            if (tile['type'], tile['variant']) in id_pairs:
                matches.append(tile.copy())
                if not keep:
                    self.offgrid_tiles.remove(tile)
                    
        for loc in list(self.tilemap):
            tile = self.tilemap[loc]
            if (tile['type'], tile['variant']) in id_pairs:
                matches.append(tile.copy())
                matches[-1]['pos'] = matches[-1]['pos'].copy()
                matches[-1]['pos'][0] *= self.tile_size
                matches[-1]['pos'][1] *= self.tile_size
                if not keep:
                    del self.tilemap[loc]
        
        return matches


    def tiles_around(self, pos):
        tiles = []
        tile_loc = (int(pos[0] // self.tile_size), int(pos[1] // self.tile_size))
        for offset in NEIGHBOR_OFFSETS:
            check_loc = str(tile_loc[0] + offset[0]) + ';' + str(tile_loc[1] + offset[1])
            if check_loc in self.tilemap:
                tiles.append(self.tilemap[check_loc])
        return tiles
    
    def save(self, path):
        f = open(path, 'w')
        json.dump({'tilemap': self.tilemap, 'tile_size': self.tile_size, 'offgrid': self.offgrid_tiles}, f)
        f.close()
        
    def load(self, path):
        f = open(path, 'r')  # 以讀取模式打開指定路徑的文件
        map_data = json.load(f)  # 讀取JSON文件並將其轉換為字典形式
        f.close()  # 關閉文件
        
        self.tilemap = map_data['tilemap']  # 從讀取的數據中獲取tilemap（瓦片地圖）
        self.tile_size = map_data['tile_size']  # 獲取瓦片大小
        self.offgrid_tiles = map_data['offgrid']  # 獲取離網格的瓦片

    def solid_check(self, pos):
        tile_loc = str(int(pos[0] // self.tile_size)) + ';' + str(int(pos[1] // self.tile_size))
        if tile_loc in self.tilemap:
            if self.tilemap[tile_loc]['type'] in PHYSICS_TILES:
                return self.tilemap[tile_loc]

    
    def physics_rects_around(self, pos):
        rects = []  # 用來存儲結果的矩形列表
        for tile in self.tiles_around(pos):  # 遍歷周圍的瓦片
            if tile['type'] in PHYSICS_TILES:  # 如果該瓦片的類型在物理瓦片列表中
                rects.append(pygame.Rect(tile['pos'][0] * self.tile_size, tile['pos'][1] * self.tile_size, self.tile_size, self.tile_size))  # 創建一個pygame矩形，並將其加入列表
        return rects  # 返回所有符合條件的矩形

    
    def autotile(self):
        for loc in self.tilemap:
            tile = self.tilemap[loc]
            neighbors = set()
            for shift in [(1, 0), (-1, 0), (0, -1), (0, 1)]:
                check_loc = str(tile['pos'][0] + shift[0]) + ';' + str(tile['pos'][1] + shift[1])
                if check_loc in self.tilemap:
                    if self.tilemap[check_loc]['type'] == tile['type']:
                        neighbors.add(shift)
            neighbors = tuple(sorted(neighbors))
            if (tile['type'] in AUTOTILE_TYPES) and (neighbors in AUTOTILE_MAP):
                tile['variant'] = AUTOTILE_MAP[neighbors]  


    def render(self, surf, offset = (0, 0)):     
        for tile in self.offgrid_tiles:     # 繪製不在網格上的磚塊（例如裝飾物、漂浮物件等）
            surf.blit(self.game.assets[tile['type']][tile['variant']], (tile['pos'][0] - offset[0], tile['pos'][1] - offset[1]))
         # 計算目前畫面內需要繪製的磚塊範圍（依照攝影機偏移量 offset）
        for x in range(offset[0] // self.tile_size, (offset[0] + surf.get_width()) // self.tile_size + 1):
            for y in range(offset[1] // self.tile_size, (offset[1] + surf.get_height()) // self.tile_size + 1):
                loc = str(x) + ';' + str(y)
                if loc in self.tilemap:     # 如果這個位置有磚塊，就進行繪製
                    tile = self.tilemap[loc]
                    surf.blit(self.game.assets[tile['type']][tile['variant']],(tile['pos'][0] * self.tile_size - offset[0], tile['pos'][1] * self.tile_size - offset[1]))   #繪製
                    
  

