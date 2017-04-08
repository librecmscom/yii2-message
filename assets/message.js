/**
 * 获取未读短消息数
 * @param callback
 */
function getUnreadMessages(callback) {
    callback = callback || jQuery.noop;
    jQuery.getJSON("/message/message/unread-messages", function (result) {
        return callback(result.total);
    });
}