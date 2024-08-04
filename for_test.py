import pymysql
import pypy
import numpy as np
import random
import pandas as pd

conn  = pymysql.connect(host = '127.0.0.1', user = 'root', password = 'Gunwoo((@))73150',db="joljak",port=6866)
cur = conn.cursor()


def maketo_price(price,percent):
    new_price = price + (price*percent)/100
    return new_price

# print(maketo_price(1000,random.uniform(-30,30)))

a = []

data = pd.read_csv('C:\\005930KS.csv')
for i in range(len(data["Open"])):
    a.append(maketo_price(data["Open"][i],random.uniform(-30,30)))
 





# for w in range(600):
#     text = "a"+str(w)
#     init_sql = "INSERT INTO pred (id, ticker, score, minus_score) VALUES ("+text+", 005930, 1 , 0)"
#     cur.execute(init_sql)
#     conn.commit()


# data = pd.read_csv('C:\\005930KS.csv')

# lenof_data = len(data["Open"])

# for i in range(lenof_data):
#     a = []
#     for b in range(100):


# sql = "SELECT day_pn FROM stock WHERE stock_ticker = 005930"

# cur.execute(sql)
# result_check_preded = cur.fetchall()

# print(result_check_preded)



