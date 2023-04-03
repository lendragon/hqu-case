const express = require('express');
const app = express();
app.get('/server',(require,response)=>{ //设置get请求的返回结果
                                        //设置响应头 设置允许跨域
    response.setHeader('Access-Control-Allow-Origin','*');
    //设置响应体
    response.send('Hello Ajax GET');
});

app.all('/server',(require,response)=>{ //all可以接受任意类型的请求
                                        //设置响应头 设置允许跨域
    response.setHeader('Access-Control-Allow-Origin','*');
    //响应头
    response.setHeader('Access-Control-Allow-Headers','*');
    //设置响应体
    response.send("Hello Ajax POST");
});

app.all('/json-server',(require,response)=>{ //all可以接受任意类型的请求
    //设置响应头 设置允许跨域
    response.setHeader('Access-Control-Allow-Origin','*');
    //响应头
    response.setHeader('Access-Control-Allow-Headers','*');
    //设置响应体
    response.send(str);
});

app.all('/post',(require,response)=>{ //all可以接受任意类型的请求
                                             //设置响应头 设置允许跨域
    response.setHeader('Access-Control-Allow-Origin','*');
    //响应头
    response.setHeader('Access-Control-Allow-Headers','*');
    //响应一个数据
    //设置响应体
    let str = "haha";
    console.log("post");
    /*str.open("GET", "../i_code_ajax.php?phone=", true);*/
    response.send(str);
});
//针对IE缓存
app.get('/ie',(require,response)=>{ //all可以接受任意类型的请求
                                    //设置响应头 设置允许跨域
    response.setHeader('Access-Control-Allow-Origin','*');
    //响应头
    response.setHeader('Access-Control-Allow-Headers','*');
    //响应一个数据
    const data = {
        "i_code":123546
    };
    //对对象进行字符串转换
    let str = JSON.stringify(data);
    //设置响应体
    response.send(str);
});
//延时响应
app.get('/ie',(require,response)=>{ //all可以接受任意类型的请求
                                    //设置响应头 设置允许跨域
    response.setHeader('Access-Control-Allow-Origin','*');
    setTimeout(function(){
        //设置响应体
        response.send("延时响应");
    },3000);

});
app.listen(3000,()=>{
    console.log('服务已经启动,3000端口监听中...');
});