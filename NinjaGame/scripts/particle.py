# 樹或衝刺粒子特效
class Particle:
    def __init__(self, game, p_type, pos, velocity = [0, 0], frame = 0):
        self.game = game                    # 儲存遊戲主物件
        self.type = p_type                  # 粒子的類型
        self.pos = list(pos)                # 粒子目前位置
        self.velocity = list(velocity)      # 粒子的速度(x,y)
        self.animation = self.game.assets['particle/' + p_type].copy()  # 從資源中複製對應的動畫
        self.animation.frame = frame        # 設定動畫的起始幀

    def update(self):
        kill = False                    # 是否要刪除這個粒子
        if self.animation.done:         # 如果動畫播放完了，就標記為刪除
            kill = True                 
        
        # 根據速度更新位置
        self.pos[0] += self.velocity[0]
        self.pos[1] += self.velocity[1]

        # 更新動畫狀態(切換幀)
        self.animation.update()

        return kill         # 回傳是否要刪除這個粒子
    
    def render(self, surf, offset = (0, 0)):    
        # 取得目前動畫要顯示的圖片
        img = self.animation.img()
        # 繪製圖片在畫面上(以粒子中心點為準)
        surf.blit(img, (self.pos[0] - offset[0] - img.get_width() // 2, self.pos[1] - offset[1] - img.get_height() // 2))