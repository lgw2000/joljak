import pymysql
import numpy as np

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

def check_minus(id,ticker):
    check_score_sql = "SELECT minus_score FROM score WHERE id = %s AND ticker = %s"
    cur.execute(check_score_sql,(id,ticker))
    result_check_preded = cur.fetchall()
    score = result_check_preded[0][0]

    return score

def cal_actual(ticker):
    check_score_sql = "SELECT stock_price FROM stock WHERE stock_ticker = %s"
    cur.execute(check_score_sql,(str(ticker)))
    result_check_preded = cur.fetchall()
    actual_number = result_check_preded[0][0]

    return actual_number








def result_error(min_error, max_error, avg_error,input_error):
    x = np.linspace(input_error,input_error,1)
    y = 2 * (1 - (x - min_error) / (max_error - min_error)) - 1
    y[x <= avg_error] = np.interp(x[x <= avg_error], [min_error, avg_error], [1 , 0])
    y[x >= avg_error] = np.interp(x[x >= avg_error], [avg_error, max_error], [0, -1])
    y = y.tolist()
    y = y[0]
    if(min_error==max_error==avg_error): #보통 가장 작은 오차 가장 큰 오차 평균오차가 같을수는 없다고 생각하여 이런 경우는 예측인원이 한사람 이라고 생각했다.
        return 0
    return y

def check_cp_error(ticker,input):
    check_now_sql = "SELECT stock_price FROM stock WHERE stock_ticker = %s"
    check_week_ago_sql = "SELECT week_ago FROM stock WHERE stock_ticker = %s"
    cur.execute(check_now_sql,(str(ticker)))
    result_check_now = cur.fetchall()
    cur.execute(check_week_ago_sql,(str(ticker)))
    result_check_week = cur.fetchall()
    result = ""
    result_check_now= float(result_check_now[0][0])
    result_check_week = float(result_check_week[0][0])
    if(result_check_now > result_check_week):
        result = "call"
    elif(result_check_now < result_check_week):
        result = "put"
    else:
        result = "0"
    
    if(input == result):
        return 1
    elif(result=="0"):
        return 0
    else:
        return -1


def make_abs_error(ticker,list_of_inputs):
    actual = float(cal_actual(ticker))
    list_of_error = [(i - actual) for i in list_of_inputs]
    abs_of_error = [abs(i) for i in list_of_error]
    return abs_of_error





for i in check_stock:
    dic_of_pred = dict()
    dic_of_pred["id"] = []
    dic_of_pred["input"] = []
    dic_of_pred["score"] = []
    dic_of_pred["minus"] = []

    dic_of_cp = dict()
    dic_of_cp["id"] = []
    dic_of_cp["input"] = []
    dic_of_cp["score"] = []
    dic_of_cp["minus"] = []

    check_preded = "SELECT * FROM pred WHERE pred_ticker = %s and pred_len = 'week'"
    cur.execute(check_preded,(str(i)))
    result_check_preded = cur.fetchall()
    if(len(result_check_preded)==0):
        #예측이 단 하나라도 없을때 아무것도 하지 않음
        print("not preded   "+str(i))
    else:
        #예측이 하나 이상 있을때
        print(result_check_preded)
        for j in result_check_preded:
            if(str(j[1]).isdigit()):
                dic_of_pred["id"].append(j[0])
                dic_of_pred["input"].append(float(j[1]))
                dic_of_pred["score"].append(float(check_score(j[0],i)))
                dic_of_pred['minus'].append(float(check_minus(j[0],i)))
            else:
                if(j[1]=="call"):
                    dic_of_cp["id"].append(j[0])
                    dic_of_cp["input"].append("call")
                    dic_of_cp["score"].append(float(check_score(j[0],i)))
                    dic_of_cp['minus'].append(float(check_minus(j[0],i)))
                else:
                    dic_of_cp["id"].append(j[0])
                    dic_of_cp["input"].append("put")
                    dic_of_cp["score"].append(float(check_score(j[0],i)))
                    dic_of_cp['minus'].append(float(check_minus(j[0],i)))
        abs_of_error = make_abs_error(i,dic_of_pred['input'])
        not_have_pred_num = 0
        try:
            mini = min(abs_of_error)
            maxi = max(abs_of_error)
            averag = sum(abs_of_error)/len(abs_of_error)
        except:
            not_have_pred_num = 1
            
        result_pn_scores = []
        result_cp_scores = []

        if not_have_pred_num != 1:
            for g in range(len(dic_of_pred['id'])):
                result_pn_scores.append(result_error(mini,maxi,averag,abs_of_error[g]))

        for w in range(len(dic_of_cp['id'])):
            result_cp_scores.append(check_cp_error(str(i),dic_of_cp['input'][w]))

        next_score = 0
        if not_have_pred_num != 1:
            for gg in range(len(dic_of_pred['id'])):
                next_score = float(dic_of_pred["score"][gg]) + float(dic_of_pred["minus"][gg]) + float(result_pn_scores[gg])
                if next_score < 0 :
                    dic_of_pred["score"][gg] = 0
                    dic_of_pred["minus"][gg] = next_score
                else:
                    dic_of_pred['score'][gg] = next_score
                    dic_of_pred['minus'][gg] = 0

        next_score = 0

        for ww in range(len(dic_of_cp['id'])):
            next_score = float(dic_of_cp["score"][ww]) + float(dic_of_cp["minus"][ww]) + float(result_cp_scores[ww])
            if next_score < 0 :
                dic_of_cp["score"][ww] = 0
                dic_of_cp["minus"][ww] = next_score
            elif next_score==0:
                dic_of_cp['score'][ww] = next_score
                dic_of_cp['minus'][ww] = 0
            else:
                dic_of_cp['score'][ww] = next_score
                dic_of_cp['minus'][ww] = 0

        
        if not_have_pred_num != 1:
            for ggg in range(len(dic_of_pred['id'])):
                update_sqls = "UPDATE score SET score = %s , minus_score = %s WHERE id = %s AND ticker = %s"
                cur.execute(update_sqls,(str(dic_of_pred['score'][ggg]),str(dic_of_pred['minus'][ggg]),str(dic_of_pred['id'][ggg]),str(i)))
                conn.commit()

        for www in range(len(dic_of_cp['id'])):
            update_sqls = "UPDATE score SET score = %s , minus_score = %s WHERE id = %s AND ticker = %s"
            cur.execute(update_sqls,(str(dic_of_cp['score'][www]),str(dic_of_cp['minus'][www]),str(dic_of_cp['id'][www]),str(i)))
            conn.commit()



        del_sqls = "DELETE FROM pred WHERE pred_len = 'week' AND pred_ticker = %s"
        cur.execute(del_sqls,(str(i)))
        conn.commit()


        

        
        
            


    

        

        

cur.close()
conn.close()