var isShow = false;
$div = document.getElementById("upload_container");
var status_text = document.getElementById("status");

var btn = document.getElementById('btn');
    btn.style.visibility = "hidden";

document.querySelector('#upload_file').addEventListener('change', function () {

    progress = document.querySelector('progress');
    // this.files[0] 是用户选择的文件
    var that = this;
    lrz(that.files[0], {width: 500}, {height: 500})
        .then(function (rst) {
            // 把处理的好的图片给用户看

            // 重新加载图片时，remove 原来的img 对象（
            if ($('img').length > 0) {
                $('img').remove();
            }

            var img = new Image();
            img.src = rst.base64;

           /* var p = document.createElement('p');

            var sourceSize = toFixed2(that.files[0].size / 1024);
            var resultSize = toFixed2(rst.fileLen / 1024);
            var scale = (100 - (resultSize / sourceSize * 100));

            p.innerHTML = "压缩前的文件大小: " + sourceSize + "KB" +
            "<br />" + "压缩后的文件大小: " + resultSize + "KB" + "<br />"
            + "省了: " + scale + "%";

            document.body.appendChild(p);*/

            img.onload = function () {
                // img.marigin = "center";
                // document.body.appendChild(img);
                $div.appendChild(img);
                progress.value = 0;
                btn.style.visibility = "visible";
                isShow = true; //当图片加载在页面上才能上传
                status_text.innerHTML = "请上传图片！";
            };
            

            return rst;
        });
});

/*function toFixed2 (num) {
    return parseFloat(+num.toFixed(2));  //toFixed(2),保留两位小数
}
*/



$('#btn').click(function () {
    

    // 获取file对象并检测是否加载完图片
    if (isShow == true && $('img').length >0) {

        status_text.innerHTML = "正在为你压缩、上传图片中！";

        var selectedFile = $('#upload_file').get(0).files[0]; 

        lrz(selectedFile, {width: 500}, {height: 500})
            .then(function (rst) {
                // 这里该上传给后端啦

                /* ==================================================== */
                // 原生ajax上传代码，所以看起来特别多 ╮(╯_╰)╭，但绝对能用
                // 其他框架，例如jQuery处理formData略有不同，请自行google，baidu。
                var xhr = new XMLHttpRequest();
                var data = {
                    base64: rst.base64,
                };
                xhr.open('POST', '/change_pic.php');
                xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // 上传成功
                        status_text.innerHTML = "上传成功";
                        // $div.appendChild(status);
                        // progress.value = 0;
                        // alert("2秒后跳转到个人信息页面！");
                        setTimeout(window.location.href='show_info.php', 5);
                        
                    } else {
                        // 处理其他情况
                        
                    }
                };

                xhr.onerror = function () {
                    // 处理错误
                };

                xhr.upload.onprogress = function (e) {
                    // 上传进度
                    progress.value = ((e.loaded / e.total) || 0) * 100;
                };

                // 添加参数
                // rst.formData.append('fileLen', rst.fileLen);
                // rst.formData.append('xxx', '我是其他参数');

                // 触发上传
                xhr.send(rst.base64);
                /* ==================================================== */
                isShow= false;  //已上传完成，不可再上传。
                return rst;
            })

            .catch(function (err) {
                // 万一出错了，这里可以捕捉到错误信息
                // 而且以上的then都不会执行
                alert(err);
            })

            .always(function () {
                // 不管是成功失败，这里都会执行
            });
    } else {
        alert("请在图片压缩、加载完成后才上传！");
    }
});
