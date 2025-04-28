import pygame as pg

pg.init()#初始化

screen=pg.display.set_mode((300,300))

pg.display.set_caption("Hole.io")#視窗名

screen.fill((0,0,0))#視窗填入黑色

# pg.draw.circle(screen , [50,50,50] , [100, 150] , 15 , 5)

# re = pg.draw.rect(screen , [150,244,156] , [35,35,30,30],30)
# re = pg.draw.rect(screen , [150,244,152] , [65,35,30,30], 30)
# re = pg.draw.rect(screen , [150,244,152] , [35,65,30,30], 30)
# re = pg.draw.rect(screen , [150,244,152] , [65,65,30,30], 30)

pg.draw.line(screen, [255,150,210], (125 , 50), (125, 200), 2)
pg.draw.line(screen, [255,150,210], (175 , 50), (175, 200), 2)
pg.draw.line(screen, [255,150,210], (75 , 100), (225, 100), 2)
pg.draw.line(screen, [255,150,210], (75 , 150), (225, 150), 2)
last = "X"
table = [7,7,7,7,7,7,7,7,7]
winOrLose = False
while True:
    ev = pg.event.get()
    # proceed events
    for event in ev:
        # handle MOUSEBUTTONUP
        if event.type == pg.MOUSEBUTTONUP and winOrLose == False:
            pos = pg.mouse.get_pos()
            x,y = pos
            for j in range(3):
                for i in range(3):
                    if 75+j*50 < x and x < 125+j*50 and 50 + i*50 < y and y < 100 + i*50:
                        if table[j*1+i*3] != 7:#table為7代表此格沒劃過，反過來說劃過了就不往下˙，
                            break
                        if last == "X":
                            pg.draw.circle(screen , [240,80,90] , [100+j*50 , 75+i*50] , 15 ,2)
                            last = "O"
                            table[j*1+i*3] = 'O'
                        else:
                            pg.draw.line(screen , [240,80,90], [85+j*50,60+i*50], [115+j*50,90+i*50] , 2)
                            pg.draw.line(screen , [240,80,90], [115+j*50,60+i*50], [85+j*50,90+i*50] , 2)
                            last = "X"
                            table[j*1+i*3] = 'X'
            print(*table)
            for i in range(3):
                if table[0+i*3] == table[1+i*3] == table[2+i*3] and table[0+i*3] != 7:
                    winOrLose = True
                    print(table[0+i*3] , "Win")
                    pg.draw.line(screen , [230 , 240 , 110] , [85,75+i*50] , [215,75+i*50] , 5)
                if table[0+i] == table[3+i] == table[6+i] and table[0+i] != 7:
                    winOrLose = True
                    print(table[0 + i], "Win")
                    pg.draw.line(screen , [230 , 240 , 110] , [100+i*50,50] , [100+i*50,200] , 5)
                #Win時顯示的斜線
                if table[0] == table[4] == table[8] and table[4] != 7:
                    winOrLose = True
                    print(table[0] , "Win")
                    pg.draw.line(screen , [230, 240, 110] ,[75,50] ,[225,200] ,5)
                if table[2] == table[4] == table[6] and table[4] != 7:
                    winOrLose = True
                    print(table[0] , "Win")
                    pg.draw.line(screen, [230, 240, 110] ,[225,50] ,[75,200] ,5)
    pg.display.update()#更新畫面(放在最後)

