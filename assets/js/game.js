$(function() {
    $("div.card").click(function() {
        if ($(this).children().length > 0) {
            return;
        }

        if ($("div.card img").length == 2 || $(this).hasClass('blank')) {
            return;
        }

        var data = {index: $(this).attr("data-index")};

        $.ajax(
            {
                url:"/check-result",
                data: data,
                success: function(response) {
                    if (response == undefined) {
                        return;
                    }

                    const result = response.data;

                    if (result.currentImage != "") {

                        var path = 'assets/images/' + result.currentImage;
                        var img = $('<img />', {src: path});
                        img.appendTo($("div.card[data-index='"+ data.index +"']"));
                    }

                    if (result.isMatch == true) {
                        setTimeout(function() {
                            $("div.card img").parent().toggleClass('card blank');
                            $("div.blank img").remove();
                            if (result.remainingCards == 0) {
                                alert('You win');
                                location.reload();
                            }
                        }, 1000);

                    } else if (result.attempt != 1) {
                        setTimeout(function() {
                            $("div.card img").remove();
                        }, 1000);
                    }
                }
            }
        );

    });
});