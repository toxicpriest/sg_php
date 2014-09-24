$(document).ready(function () {
    $("#playerCountDrop").change(function () {
        var playerCount = this.options[this.selectedIndex].text;
        var playerCountHtml = "";
        for (var i = 1; i <= playerCount; i++) {
            var playerID = "#Player" + i + " input";
            if ($(playerID).length) {
                var PlayerName = $(playerID).val();
                playerCountHtml += "<div id='Player" + i + "'><label>Player: " + i + "</label><input name='Player" + i + "' type='text' value='" + PlayerName + "'></div>";
            }
            else {
                playerCountHtml += "<div id='Player" + i + "'><label>Player: " + i + "</label><input name='Player" + i + "' type='text'></div>";
            }
        }
        $("#players").html(playerCountHtml);
    });
    $("#drinkCountDrop").change(function () {
        var drinkCount = this.options[this.selectedIndex].text;
        var drinkCountHtml = "";
        for (var i = 1; i <= drinkCount; i++) {
            var drinkID = "#Drink" + i + " input";
            if ($(drinkID).length) {
                var drinkName = $(drinkID).val();
                drinkCountHtml += "<div id='Drink" + i + "'><label>Drink: " + i + "</label><input name='Drink" + i + "' type='text' value='" + drinkName + "'></div>";
            }
            else {
                drinkCountHtml += "<div id='Drink" + i + "'><label>Drink: " + i + "</label><input name='Drink" + i + "' type='text'></div>";
            }
        }
        $("#drinks").html(drinkCountHtml);
    });

    $('body').delegate('#taskBtn', 'click', function(event) {
        $.ajax({
            url: "task_handler.php",
            context: document.body
        }).done(function (data) {
                if (data != "" && data != null) {
                    var obj = $.parseJSON(data);
                    $("#players").html(obj.playerboard);
                    $("#taskWidow").html(obj.task);
                    $("#ActiveButton").html(obj.activeBtn);
                    $("#actions").html(obj.actions);
                }
            });
    })
    $('body').delegate('#actionBtn', 'click', function(event) {
        $.ajax({
            url: "action_handler.php",
            context: document.body
        }).done(function (data) {
                if (data != "" && data != null) {
                    var obj = $.parseJSON(data);
                    $("#players").html(obj.playerboard);
                    $("#taskWidow").html(obj.action);
                    $("#ActiveButton").html(obj.activeBtn);
                }
            });
    })
    $('body').delegate('.activeAction', 'mousemove', function(e)
    {
       var hiddenInfo= $(this).children(".hiddenActionInfo");
        hiddenInfo.css( "display", "block" );
        x = (e.pageX ? e.pageX : window.event.x) + hiddenInfo.offsetParent.scrollLeft - hiddenInfo.offsetParent.offsetLeft;
        y = (e.pageY ? e.pageY : window.event.y) + hiddenInfo.offsetParent.scrollTop - hiddenInfo.offsetParent.offsetTop;
        var left = (e.pageX + 20) + "px";
        var top = (e.pageY) + "px";
        hiddenInfo.css("left",left);
        hiddenInfo.css("top",top);
    })
    $('body').delegate('.activeAction', 'mouseleave', function(e)
    {
        $(this).children(".hiddenActionInfo").css( "display", "none" );
    })
})
