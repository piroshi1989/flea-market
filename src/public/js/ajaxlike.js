$(document).ready(function() {
  $('.like-toggle').each(function() {
    const $this = $(this);
    const itemId = $this.data('item-id');
    const userId = $this.data('user-id');

    // ローカルストレージからお気に入りの状態を取得
    const localStorageKey = `like_${itemId}_${userId}`;
    const isLiked = localStorage.getItem(localStorageKey) === 'true';

    if (isLiked) {
      $this.addClass('liked');
    }

    $this.on('click', function() {
      // Ajaxリクエストを送信
      $.ajax({
        type: isLiked ? 'DELETE' : 'POST',
        url: isLiked ? `/like/${itemId}` : `/like/${itemId}`,
        data: {
          item_id: itemId,
          user_id: userId,
          _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data) {
          // 成功時の処理
          if (data.liked) {
            $this.addClass('liked');
            localStorage.setItem(localStorageKey, 'true'); // お気に入りの状態を保存
          } else {
            $this.removeClass('liked');
            localStorage.removeItem(localStorageKey); // お気に入りの状態を削除
          }

                $.ajax({
        type: 'GET',
        url: `/getLikeCount/${itemId}`,
        success: function(countData) {
          // カウントを表示
          $('.like-count').text(countData.likeCount);
        },
        error: function(error) {
          console.log(error);
        },
      });
        },
        error: function(error) {
          // エラー時の処理
          console.log(error);
        },
      });
    });
  });
});