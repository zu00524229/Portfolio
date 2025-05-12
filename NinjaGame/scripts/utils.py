import os

import pygame


BASE_IMG_PATH = 'data/images/'

def load_image(path):
    img = pygame.image.load(BASE_IMG_PATH + path).convert()
    img.set_colorkey((0, 0, 0))  # 設定黑色為透明色
    return img

def load_images(path):
    images = []     # 用來存放多張圖片（動畫用）
    for img_name in sorted(os.listdir(BASE_IMG_PATH + path)):   
        images.append(load_image(path + '/' + img_name))    
    return images

class Animation:    # 動畫
    def __init__(self, images, img_dur = 5, loop = True):
        self.images = images            # 傳入的圖片列表（每一幀一張圖）
        self.loop = loop                # 是否重複播放動畫
        self.img_duration = img_dur     # 每張圖片停留幾幀（幀數越大播放越慢）
        self.done = False               # 非循環動畫是否已播放完畢（目前沒被使用，但可擴充用）
        self.frame = 0                  # 當前動畫的幀計數器（從0開始）
        
    def copy(self):         # 複製一份動畫（不會互相干擾）
        return Animation(self.images, self.img_duration, self.loop)
    
    def update(self):
        if self.loop:   # 如果是循環播放，當前幀數會一直重複循環（例如：0→1→2→0→1...）
            self.frame = (self.frame + 1) % (self.img_duration * len(self.images))  
        else:   # 如果是非循環播放，幀數到尾端就不再前進
            self.frame = min(self.frame + 1, self.img_duration * len(self.images) - 1)
            if self.frame >= self.img_duration * len(self.images) - 1:
                self.done = True

    def img(self):  # 根據當前幀數，回傳對應的圖片
        return self.images[int(self.frame / self.img_duration)]