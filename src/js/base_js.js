$(document).ready(function () {
    $("#playerCountDrop").change(function () {
        var playerCount = this.options[this.selectedIndex].text;
        var playerCountHtml = "";
        for (var i = 1; i <= playerCount; i++) {
            var playerID = "#Player" + i + " input";
            if ($(playerID).length) {
                var PlayerName = $(playerID).val();
                playerCountHtml += "<div id='Player" + i + "'><label>Player: " + i + "</label><input id='playerInput" + i + "'  name='Player" + i + "' type='text' value='" + PlayerName + "'></div>";
            }
            else {
                playerCountHtml += "<div id='Player" + i + "'><label>Player: " + i + "</label><input id='playerInput" + i + "' name='Player" + i + "' type='text'></div>";
            }
        }
        $("#players").html(playerCountHtml);
    });
    $("#drinkCountDrop").change(function () {
        var drinkCount = this.options[this.selectedIndex].text;
        var drinkCountHtml = "";
        for (var i = 1; i <= drinkCount; i++) {
            var drinkID = "#Drink" + i + " .drinkinput";
            var test =$(drinkID).val();
            var drinkAmountID = "#Drink" + i + " .drinkamountinput";
            if ($(drinkID).length) {
                var drinkName = $(drinkID).val();
                var drinkAmount = $(drinkAmountID).val();
                drinkCountHtml += "<div id='Drink" + i + "'><label>Drink: " + i + "</label><input class='drinkinput' id='drinkInput" + i + "' name='Drink" + i + "' type='text' value='" + drinkName + "'><label>Einheit:</label><input class='drinkamountinput' id='drinkAmountInput" + i + "' name='DrinkAmount" + i + "' type='text' value='" + drinkAmount + "'></div>";
            }
            else {
                drinkCountHtml += "<div id='Drink" + i + "'><label>Drink: " + i + "</label><input class='drinkinput' id='drinkInput" + i + "' name='Drink" + i + "' type='text'><label>Einheit: </label><input class='drinkamountinput' id='drinkAmountInput" + i + "' name='DrinkAmount" + i + "' type='text'></div></div>";
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
                    $("#playersInfo").html(obj.playerboard);
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
                    $("#playersInfo").html(obj.playerboard);
                    $("#taskWidow").html(obj.action);
                    $("#ActiveButton").html(obj.activeBtn);
                    $("#actions").html(obj.actions);
                        $.each(obj.endedTasks, function() {
                            alert(this.text);
                        })
                }
            });
    })
    $('body').delegate('#diceBtn', 'click', function(event) {
        $.ajax({
            url: "dice_handler.php",
            context: document.body
        }).done(function (data) {
                if (data != "" && data != null) {
                    var obj = $.parseJSON(data);
                    alert(obj.randomNumberText);
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

function chkFormular(){
    var formularSuccess = true;
    if($("#playerCountDrop").val() == "Please Choose"){
        $("#playerCountDrop").css("color","red");
        formularSuccess=false;
    }
    if($("#drinkCountDrop").val() == "Please Choose"){
            $("#drinkCountDrop").css("color","red");
            formularSuccess=false;
    }
    if($("#maxAmountDrop").val() == "Please Choose"){
        $("#maxAmountDrop").css("color","red");
        formularSuccess=false;
    }
    if($("#wonAtDrop").val() == "Please Choose"){
        $("#wonAtDrop").css("color","red");
        formularSuccess=false;
    }
    if($("#tasksDrop").val() == "Please Choose"){
        $("#tasksDrop").css("color","red");
        formularSuccess=false;
    }
    if($("#playerCountDrop").val() != "Please Choose"){
        var playerCount2=parseInt($("#playerCountDrop").val());
        for (var i = 1; i <= playerCount2; i++) {
            var playerInputfield="#playerInput"+i;
            if($(playerInputfield).val() ==""){
                $(playerInputfield).css("background","#f00");
                formularSuccess=false;
            }
        }
    }
    if($("#drinkCountDrop").val() != "Please Choose"){
        var drinkCount2=parseInt($("#drinkCountDrop").val());
        for (var i = 1; i <= drinkCount2; i++) {
            var drinkInputfield="#drinkInput"+i;
            if($(drinkInputfield).val() ==""){
                $(drinkInputfield).css("background","#f00");
                formularSuccess=false;
            }
        }
    }
    if($("#drinkCountDrop").val() != "Please Choose"){
        var drinkCount3=parseInt($("#drinkCountDrop").val());
        for (var i = 1; i <= drinkCount3; i++) {
            var drinkAmountInputfield="#drinkAmountInput"+i;
            if($(drinkAmountInputfield).val() ==""){
                $(drinkAmountInputfield).css("background","#f00");
                formularSuccess=false;
            }
        }
    }
    if(!formularSuccess){
        return false;
    }

}
