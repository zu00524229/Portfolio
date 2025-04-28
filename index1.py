# # 判斷三角形類型
a = float(input("請輸入a: "))
b = float(input("請輸入b: "))
c = float(input("請輸入c: "))

if a + b > c and b + c > a and a + c > b:
    if a == b == c:
        print("正三角形")
    elif a == b or b == c or a == c:
        print("等腰三角形")
    else:
        print("不等邊三角形")

    sides = sorted([a, b, c])
    x, y, z = sides

    if x ** 2 + y ** 2 == z ** 2:
        print("直角三角形")
    elif x ** 2 + y ** 2 > z ** 2:
        print("銳角三角形")
    else:
        print("鈍角三角形")
else:
    print("無法組成三角形")


# 無條件捨去小數點
s = float(input())
print(int(s))        # 無條件捨去
# print(int(s // 1)) # 無條件捨去
# print(int(s+0.5))   # 四捨五入