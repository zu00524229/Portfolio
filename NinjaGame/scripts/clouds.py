import random

class Cloud:    # 雲朵
    def __init__(self, pos, img, speed, depth):
        self.pos = list(pos)     # 雲的位置（list，因為會改變）
        self.img = img           # 雲朵圖像（pygame 的圖片物件）
        self.speed = speed       # 雲的移動速度
        self.depth = depth       # 深度（決定視差效果的強弱，越小越遠）

    def update(self):
        self.pos[0] += self.speed   # 每幀讓雲向右移動（造成漂浮效果）

    def render(self, surf, offset = (0, 0)):    # 根據畫面偏移量與雲朵深度計算繪製位置（模擬視差）
        render_pos = (self.pos[0] - offset[0] * self.depth, self.pos[1] - offset[1] * self.depth)
        #  讓雲朵在畫面邊界平滑重複出現（無限捲動）
        surf.blit(self.img, (render_pos[0] % (surf.get_width() + self.img.get_width()) - self.img.get_width(), render_pos[1] % (surf.get_height() + self.img.get_height()) - self.img.get_height()))

class Clouds:   
    def __init__(self, cloud_images, count = 16):   #   繪製與數量雲朵
        self.clouds = []

        for i in range(count):  #   隨機數量(x, y, 上升速度, 深度,)
            self.clouds.append(Cloud((random.random() * 99999, random.random() * 99999), random.choice(cloud_images), random.random() * 0.05 + 0.05, random.random() * 0.6 + 0.2))

        self.clouds.sort(key = lambda x: x.depth)

    def update(self):
        for cloud in self.clouds:
            cloud.update()

    def render(self, surf, offset = (0, 0)):
        for cloud in self.clouds:
            cloud.render(surf, offset = offset)