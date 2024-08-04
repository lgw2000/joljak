import pymysql

conn  = pymysql.connect(host = '127.0.0.1', user = 'root', password = 'Gunwoo((@))73150',db="joljak",port=6866)
cur = conn.cursor()


check_stocks_sql= "SELECT stock_ticker FROM stock"

cur.execute(check_stocks_sql)
result = cur.fetchall()

check_stock = []
for i in range(len(result)):
    check_stock.append(result[i][0])





def check_score(id,ticker):
    check_score_sql = "SELECT score FROM score WHERE id = %s AND ticker = %s"
    cur.execute(check_score_sql,(id,ticker))
    result_check_preded = cur.fetchall()
    score = result_check_preded[0][0]

    return score



for i in check_stock:
    dic_of_pred = dict()
    dic_of_pred["id"] = []
    dic_of_pred["input"] = []
    dic_of_pred["score"] = []
    check_preded = "SELECT * FROM pred WHERE pred_ticker = %s and pred_len = 'week'"
    cur.execute(check_preded,(str(i)))
    result_check_preded = cur.fetchall()
    if(len(result_check_preded)==0):
        #예측이 단 하나라도 없을때
        print("not preded   "+str(i))
        no_preds_sql = "UPDATE stock SET week_pn = 0 WHERE stock_ticker = %s"
        no_callputs_sql = "UPDATE stock SET week_cp = 0 WHERE stock_ticker = %s"
        cur.execute(no_preds_sql,(str(i)))
        conn.commit()
        cur.execute(no_callputs_sql,(str(i)))
        conn.commit()
    else:
        #예측이 하나 이상 있을때
        print(result_check_preded)
        num_of_call = 0
        num_of_put = 0
        for j in result_check_preded:
            if(str(j[1]).isdigit()):
                dic_of_pred["id"].append(j[0])
                dic_of_pred["input"].append(float(j[1]))
                dic_of_pred["score"].append(float(check_score(j[0],i)))
            else:
                if(j[1]=="call"):
                    num_of_call = num_of_call + 1
                else:
                    num_of_put = num_of_put + 1
        sum_of_score = sum(dic_of_pred['score'])
        if sum_of_score <= 0:
            sum_of_score = 1
        adds = 0
        for w in range(len(dic_of_pred["id"])):
            mul = dic_of_pred['score'][w] * dic_of_pred["input"][w]
            adds = adds + mul
        week_pn = str(adds/sum_of_score)
        week_cp = str(num_of_call)+":"+str(num_of_put)
        final_preds_sql = "UPDATE `stock` SET `week_pn` = %s WHERE `stock_ticker` = %s"
        final_callputs_sql = "UPDATE `stock` SET `week_cp` = %s WHERE `stock_ticker` = %s"
        cur.execute(final_preds_sql,(week_pn,str(i)))
        conn.commit()
        cur.execute(final_callputs_sql,(week_cp,str(i)))
        conn.commit()

        

cur.close()
conn.close()

#원만한 사용을 위해 check_del_pred.php 에 날짜를 제한할것
        