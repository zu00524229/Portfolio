# 須將main 關聯 from rank import input_name_screen, draw_rank_screen, submit_score
# 改成 from singlerank import init_db, input_name_screen, draw_rank_screen, submit_score 
# 可改成單機版排行榜
import sqlite3
import pygame
from utils import draw_text
import sys

def init_db():
    conn = sqlite3.connect('scores.db')
    c = conn.cursor()
    c.execute('''
        CREATE TABLE IF NOT EXISTS scores (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            score INTEGER NOT NULL,
            creaTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ''')
    conn.commit()
    conn.close()

def submit_score(name, score):
    conn = sqlite3.connect('scores.db')
    c = conn.cursor()
    c.execute("INSERT INTO scores (name, score) VALUES (?, ?)", (name, score))
    conn.commit()
    conn.close()

def get_top_scores(limit=5):
    conn = sqlite3.connect('scores.db')
    c = conn.cursor()
    c.execute("SELECT name, score FROM scores ORDER BY score DESC LIMIT ?", (limit,))
    rows = c.fetchall()
    conn.close()
    return rows

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

        # 顯示前五名排行榜
        scores = get_top_scores()
        draw_text(screen, "排行榜", 24, WIDTH // 2, 60)
        for i, (player_name, player_score) in enumerate(scores):
            draw_text(screen, f"{i+1}. {player_name} : {player_score}", 22, WIDTH // 2, 90 + i * 25, font_name)

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

def draw_rank_screen(screen, background_img, score, WIDTH, HEIGHT, font_name):
    screen.blit(background_img, (0, 0))
    draw_text(screen, f'本局分數：{score}', 28, WIDTH / 2, HEIGHT / 8, font_name)
    draw_text(screen, '排行榜', 40, WIDTH / 2, HEIGHT / 8 + 40, font_name)

    scores = get_top_scores(10)
    for i, (player_name, player_score) in enumerate(scores):
        draw_text(screen, f"{i+1}. {player_name} : {player_score}", 24, WIDTH / 2, HEIGHT / 3 + i * 30, font_name)

    draw_text(screen, '按任意鍵再玩一次', 20, WIDTH / 2, HEIGHT * 6.5 / 8, font_name)
    pygame.display.update()

    waiting = True
    while waiting:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
                sys.exit()
                exit()
            elif event.type == pygame.KEYUP:
                waiting = False
