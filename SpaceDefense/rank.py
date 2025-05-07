import requests
from utils import draw_text

import pygame


# 顯示名稱輸入畫面 + 排行榜前 5 名
def input_name_screen(screen, background_img, score, WIDTH, HEIGHT, font_name):
    name = ""
    input_active = True
    clock = pygame.time.Clock()

    while input_active:
        screen.blit(background_img, (0, 0))
        draw_text(screen, f"你的分數: {score}", 36, WIDTH // 2, HEIGHT - 10, font_name)
        draw_text(screen, "請輸入你的名字：", 28, WIDTH // 2, HEIGHT // 2 - 20, font_name)
        draw_text(screen, name, 28, WIDTH // 2, HEIGHT // 2 + 20, font_name)
        draw_text(screen, "按 Enter 送出", 18, WIDTH // 2, HEIGHT * 3 // 4, font_name)

        # 排行榜
        try:
            r = requests.get('http://localhost/SpaceDefense/php/get_scores.php')
            rank_list = r.json()
            draw_text(screen, "排行榜", 24, WIDTH // 2, 60, font_name)
            for i, item in enumerate(rank_list[:5]):
                draw_text(screen, f"{i+1}. {item['name']} : {item['score']}", 22, WIDTH // 2, 90 + i * 25, font_name)
        except:
            draw_text(screen, "排行榜載入失敗", 20, WIDTH // 2, 60, font_name)

        pygame.display.update()
        clock.tick(60)

        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
                exit()
            elif event.type == pygame.KEYDOWN:
                if event.key == pygame.K_RETURN and name != "":
                    return name
                elif event.key == pygame.K_BACKSPACE:
                    name = name[:-1]
                elif len(name) < 10:
                    name += event.unicode

# 顯示排行榜畫面
def draw_rank_screen(screen, background_img, score, WIDTH, HEIGHT, font_name):
    screen.blit(background_img, (0, 0))
    draw_text(screen, f'本局分數：{score}', 28, WIDTH / 2, HEIGHT / 8, font_name)
    draw_text(screen, '排行榜', 40, WIDTH / 2, HEIGHT / 8 + 40, font_name)

    try:
        r = requests.get('http://localhost/SpaceDefense/php/get_scores.php')
        rank_list = r.json()
        for i, item in enumerate(rank_list[:10]):
            draw_text(screen, f"{i+1}. {item['name']} : {item['score']}", 24, WIDTH/2, HEIGHT/3 + i*30, font_name)
    except:
        draw_text(screen, '無法連接伺服器取得排行榜', 24, WIDTH / 2, HEIGHT / 2, font_name)

    draw_text(screen, '按任意鍵再玩一次', 20, WIDTH / 2, HEIGHT * 6.5 / 8, font_name)
    pygame.display.update()

    waiting = True
    while waiting:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
                exit()
            elif event.type == pygame.KEYUP:
                waiting = False

# 上傳分數
def submit_score(name, score):
    url = 'http://localhost/SpaceDefense/php/submit_score.php'
    data = {
        'name': name,
        'score': score
    }
    try:
        r = requests.post(url, data=data)
        print("伺服器回應：", r.text)
    except:
        print("送出分數失敗，請確認伺服器是否開啟")
