 function hitokoto() {
        $.ajax({
            url: 'https://qqdie.com/hitokoto/json.php',
            type: 'get',
            beforeSend: function(xhr) {
                $('#hitokoto').html('『少女祈祷中...』');
            },
            success: function(data) {
                if (data.status == 'success') {
                    $('#hitokoto').html(data.result.hitokoto);
                } else {
                    $('#hitokoto').html('失败是成功之母');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                $('#hitokoto').html('人心总有一层半透膜似的伪装');
            }
        });
    }
hitokoto();