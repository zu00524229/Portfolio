import pygame
import random
pygame.init()
win = pygame.display.set_mode((320, 240))  # 畫布視窗的大小
pygame.display.set_caption("greedy snake")  # 視窗標題
pygame.mixer.init()

pygame.mixer.music.load('Finding Hope.mp3')

# 播放音樂
pygame.mixer.music.play(-1)
# s = pygame.mixer.Sound(win.wav)  #括弧為音檔名稱
# s.set_volume(0.7)  # 設定音量大小，參值0~1
# s.play()
run = True
x = 20
ball = []
locX = [50, 120, 190, 260]
combo = 0
score = 0
font = pygame.font.SysFont("None", 24)
while run:
    # 防止cpu佔用過高
    pygame.time.delay(10)
    p = random.randint(1, 100)  # 隨機產生1~10得整數放到變數p
    if p > 99:
        ball.append([random.choice(locX), 0])
    win.fill((120, 120, 240))
    text = font.render("Score = " + str(score), True, (0, 0, 255), (120, 120, 240))
    win.blit(text, (100, 100))  # 分數座標位置
    text = font.render("Combo = " + str(combo), True, (0, 0, 255), (120, 120, 240))
    win.blit(text, (100, 120))  # 分數座標位置
    # print("分數", score)
    # print("Combo", combo)
    # print("所有球的位置", *ball)
    for i in range(len(ball)):  # 根據球的數量來跑回圈
        x, y = ball[i]  # 存取球的座標位置
        pygame.draw.circle(win, (240, 240, 120), (x, y), 20, 2)
    for event in pygame.event.get():    # 取的所有目前發生事件
        if event.type == pygame.QUIT:   # 如果點擊QUIT
            run = False                 # 則關閉視窗

            # 偵測 KeyUp 事件
        if event.type == pygame.KEYUP:
            if event.key == pygame.K_UP:
                print("放開了 ↑ 上鍵")
                for i in range(len(ball)):
                    x, y = ball[i]  # 存取求座標位置
                    if x != 120:    # 如果x不再120
                        continue    # 往下一個檢查
                    if 190 < y < 210:
                        print("P")
                        del ball[i]
                        combo += 1
                        score += 100 * combo
                        break
                    elif 180 < y < 190 or 210 < y < 220:
                        print("G")
                        del ball[i]
                        combo += 1
                        score += 30 * combo
                        break
                    # else:
                    #     combo = 0
                    #     break
            elif event.key == pygame.K_DOWN:
                print("放開了 ↓ 下鍵")
                for i in range(len(ball)):
                    x, y = ball[i]  # 存取求座標位置
                    if x != 190:    # 如果x不再190
                        continue    # 往下一個檢查
                    if 190 < y < 210:
                        print("P")
                        del ball[i]
                        combo += 1
                        score += 100 * combo
                        break
                    elif 180 < y < 190 or 210 < y < 220:
                        print("G")
                        del ball[i]
                        combo += 1
                        score += 30 * combo
                        break

            elif event.key == pygame.K_LEFT:
                print("放開了 ← 左鍵")
                for i in range(len(ball)):
                    x, y = ball[i]  # 存取求座標位置
                    if x != 50:    # 如果x不再50
                        continue    # 往下一個檢查
                    if 190 < y < 210:
                        print("P")
                        del ball[i]
                        combo += 1
                        score += 100 * combo
                        break
                    elif 180 < y < 190 or 210 < y < 220:
                        print("G")
                        del ball[i]
                        combo += 1
                        score += 30 * combo
                        break
                    else:
                        combo = 0
                        break
            elif event.key == pygame.K_RIGHT:
                print("放開了 → 右鍵")
                for i in range(len(ball)):
                    x, y = ball[i]  # 拿出第I顆球的座標
                    if x != 260:  # 如果不是最右邊的球(因為是向右鍵)
                        continue  # 就跳過下面的檢查去拿下一顆球
                    if 190 < y < 210:
                        print("P")
                        del ball[i]
                        score += 100 * combo
                        combo += 1
                        break
                    elif 180 < y < 190 or 210 < y < 220:
                        print("G")
                        del ball[i]
                        combo += 1
                        score += 30 * combo
                        break

    for i in range(len(ball)-1, -1, -1):  #
        ball[i][1] += 0.5     # 第i顆球的座標+1
        if ball[i][1] > 240:
            del ball[i]
            combo = 0

    pygame.draw.line(win, (10, 20, 30), (0, 200), (320, 200), 5)
    ###
    ### 此處放入更新遊戲畫面的程式
    ###
    pygame.display.update()
