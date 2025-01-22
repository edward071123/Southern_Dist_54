<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../admin_login.php');
    exit;
}
include '../database/db_connect.php';
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>留言管理 - 管理後台</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>留言管理</h1>
    <table id="commentsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>Email</th>
                <th>內容</th>
                <th>日期</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <!-- 留言列表 -->
        </tbody>
    </table>

    <!-- 回覆留言表單 -->
    <form id="replyForm" style="display: none;">
        <h3>回覆留言</h3>
        <input type="hidden" id="replyId">
        <textarea id="replyContent" placeholder="輸入回覆內容" required></textarea>
        <button type="submit">送出回覆</button>
        <button type="button" id="cancelReply">取消</button>
    </form>

    <script>
        // 加載留言
        function loadComments() {
            $.ajax({
                url: '../api/get_messages_admin.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const tableBody = $('#commentsTable tbody');
                    tableBody.empty();
                    data.forEach(comment => {
                        tableBody.append(`
                            <tr>
                                <td>${comment.id}</td>
                                <td>${comment.name}</td>
                                <td>${comment.email}</td>
                                <td>${comment.content}</td>
                                <td>${comment.date}</td>
                                <td>
                                    <button class="replyBtn" data-id="${comment.id}">回覆</button>
                                    <button class="deleteBtn" data-id="${comment.id}">刪除</button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function () {
                    alert('無法加載留言，請稍後再試。');
                }
            });
        }

        // 刪除留言
        $(document).on('click', '.deleteBtn', function () {
            const id = $(this).data('id');
            if (confirm('確定要刪除此留言嗎？')) {
                $.ajax({
                    url: '../api/delete_message.php',
                    method: 'POST',
                    data: { id },
                    success: function () {
                        alert('留言已刪除！');
                        loadComments();
                    },
                    error: function () {
                        alert('刪除失敗，請稍後再試。');
                    }
                });
            }
        });

        // 回覆留言
        $(document).on('click', '.replyBtn', function () {
            const id = $(this).data('id');
            $('#replyId').val(id);
            $('#replyForm').show();
        });

        // 提交回覆
        $('#replyForm').on('submit', function (event) {
            event.preventDefault();
            const id = $('#replyId').val();
            const content = $('#replyContent').val();
            $.ajax({
                url: '../api/reply_message.php',
                method: 'POST',
                data: { id, content },
                success: function () {
                    alert('回覆成功！');
                    $('#replyForm').hide();
                    loadComments();
                },
                error: function () {
                    alert('回覆失敗，請稍後再試。');
                }
            });
        });

        // 取消回覆
        $('#cancelReply').on('click', function () {
            $('#replyForm').hide();
        });

        // 初始化
        $(document).ready(function () {
            loadComments();
        });
    </script>
</body>
</html>
