from threading import Timer
import os
import datetime

def run_bot_outbox():
    # api = 'curl http://localhost:8001/api/rawbinance  && \
    #  curl http://localhost:8001/api/rawbittrex && \
    #  curl http://localhost:8001/api/rawindodax && \
    #  curl http://localhost:8001/api/rawhuobi && \
    #  curl http://localhost:8001/api/rawokex && \
    #  curl http://localhost:8001/api/rawaex && \
    #  curl http://localhost:8001/api/rawcoinsbit && \
    #  curl http://localhost:8001/api/rawbilaxy && \
    #  curl http://localhost:8001/api/rawfolgory && \
    #  curl http://localhost:8001/api/rawbkex && \
    #  \
    #  curl http://localhost:8001/api/syncindodax && \
    #  curl http://localhost:8001/api/syncbittrex && \
    #  curl http://localhost:8001/api/syncbinance && \
    #  curl http://localhost:8001/api/synchuobi && \
    #  curl http://localhost:8001/api/syncaex && \
    #  curl http://localhost:8001/api/syncokex && \
    #  curl http://localhost:8001/api/syncbilaxy && \
    #  curl http://localhost:8001/api/syncfolgory && \
    #  curl http://localhost:8001/api/synccoinsbit && \
    #  curl http://localhost:8001/api/syncbkex'
    # api = 'curl -s -o http://localhost:8001/api/rawbinance && echo "done1" & \
    #     curl -s -o http://localhost:8001/api/syncbinance && echo "done2" & \
    #     curl -s -o http://localhost:8001/api/rawbittrex && echo "done3" & \
    #     curl -s -o http://localhost:8001/api/syncbittrex && echo "done4"'
    api = 'curl -s -o foo http://dummy.restapiexample.com/api/v1/employees && echo "done1" & \
curl -s -o bar http://dummy.restapiexample.com/api/v1/employee/1 && echo "done2" & \
curl -s -o baz https://jsonplaceholder.typicode.com/todos/1 && echo "done3" & \
curl -s -o foo http://dummy.restapiexample.com/api/v1/employees && echo "done1" & \
curl -s -o bar http://dummy.restapiexample.com/api/v1/employee/1 && echo "done2" &  \
curl -s -o baz https://jsonplaceholder.typicode.com/todos/1 && echo "done3" & \
curl -s -o foo http://dummy.restapiexample.com/api/v1/employees && echo "done1" & \
curl -s -o bar http://dummy.restapiexample.com/api/v1/employee/1 && echo "done2" &  \
curl -s -o baz https://jsonplaceholder.typicode.com/todos/1 && echo "done3" & \
curl -s -o foo http://dummy.restapiexample.com/api/v1/employees && echo "done1" & \
curl -s -o bar http://dummy.restapiexample.com/api/v1/employee/1 && echo "done2" &  \
curl -s -o baz https://jsonplaceholder.typicode.com/todos/1 && echo "done3" & \
curl -s -o foo http://dummy.restapiexample.com/api/v1/employees && echo "done1" & \
curl -s -o bar http://dummy.restapiexample.com/api/v1/employee/1 && echo "done2" &  \
curl -s -o baz https://jsonplaceholder.typicode.com/todos/1 && echo "done3" & \
curl -s -o foo http://dummy.restapiexample.com/api/v1/employees && echo "done1" & \
curl -s -o bar http://dummy.restapiexample.com/api/v1/employee/1 && echo "done2" &  \
curl -s -o baz https://jsonplaceholder.typicode.com/todos/1 && echo "done3" & \
'
    # for a in api:
        # print(a)
    os.system(api)
    print(datetime.datetime.now())

# for i in range(1, 13):
#     Timer(20.0, run_bot_outbox).start()


# print(datetime.datetime.now())
run_bot_outbox()
# print(datetime.datetime.now())
