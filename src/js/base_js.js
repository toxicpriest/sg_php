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
                drinkCountHtml += "<div id='Drink" + i + "'><label>Drink: " + i + "</label><input class='drinkinput' id='drinkInput" + i + "' name='Drink" + i + "' type='text' value='" + drinkName + "'><div class='clear'></div><label>Einheit:</label><input class='drinkamountinput' id='drinkAmountInput" + i + "' name='DrinkAmount" + i + "' type='text' value='" + drinkAmount + "'></div>";
            }
            else {
                drinkCountHtml += "<div id='Drink" + i + "'><label>Drink: " + i + "</label><input class='drinkinput' id='drinkInput" + i + "' name='Drink" + i + "' type='text'><div class='clear'></div><label>Einheit:</label><input class='drinkamountinput' id='drinkAmountInput" + i + "' name='DrinkAmount" + i + "' type='text'></div></div>";
            }
        }
        $("#drinks").html(drinkCountHtml);
    });

    $('body').delegate('#taskBtn', 'click', function(event) {
        showFog();
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
        hideFog();
    })
    $('body').delegate('#actionBtn', 'click', function(event) {
        showFog();
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
                    var wholeTask = "";
                    $.each(obj.endedTasks, function () {
                        wholeTask += this.text + "<br>";
                    })
                    if (wholeTask != "") {
                        messageAlert(wholeTask);
                    }
                }
            });
        hideFog();
    })
    $('body').delegate('#diceBtn', 'click', function(event) {
        showFog();
        $.ajax({
            url: "dice_handler.php",
            context: document.body
        }).done(function (data) {
                if (data != "" && data != null) {
                    var obj = $.parseJSON(data);
                    messageAlert(obj.randomNumberText);
                    $("#ActiveButton").html(obj.activeBtn);
                }
            });
        hideFog();
    })
    $('body').delegate('.activeAction', 'mousemove', function(e)
    {
       var hiddenInfo= $(this).children(".hiddenActionInfo");
        hiddenInfo.css( "display", "block" );
        var left = (e.pageX + 20) + "px";
        var top = (e.pageY) + "px";
        hiddenInfo.css("left",left);
        hiddenInfo.css("top",top);
    })
    $('body').delegate('.activeAction', 'mouseleave', function(e)
    {
        $(this).children(".hiddenActionInfo").css( "display", "none" );
    })
    $('body').delegate('.item', 'mouseenter', function()
    {
       var hiddenItemInfo= $(this).children(".hiddenItemInfo");
        hiddenItemInfo.css( "display", "block" );
        var left = (this.offsetLeft +20) + "px";
        var top = (this.offsetTop + 20) + "px";
        hiddenItemInfo.css("left",left);
        hiddenItemInfo.css("top",top);
    })
    $('body').delegate('.item', 'mouseleave', function()
    {
        $(this).children(".hiddenItemInfo").css( "display", "none" );
    })
})
function deleteDrink(sOiD){
    messageAlert("deleteDrink "+sOiD);
    $.ajax({
        url: "drink_handler.php",
        context: document.body,
        data: {drinkID: sOiD, func:"delete"},
        type: "POST"
        }).done(function (data) {
            if (data != "" && data != null) {
                var obj = $.parseJSON(data);
                $("#drinksInfo").html(obj.drinkboard);
                messageAlert(obj.msg);
            }
        });
}
function editDrink(sOiD){
    var idName="#drink_"+sOiD;
    var idAmount ="#amount_"+sOiD;
    if($(idName).is(':disabled')){
        $(idAmount).prop("disabled", false);
        $(idName).prop("disabled", false);
    }else{
        var newName = $(idName).val();
        var newValue = $(idAmount).val();
        $.ajax({
            url: "drink_handler.php",
            context: document.body,
            data: {drinkID: sOiD, func:"edit",newName:newName,newValue:newValue},
            type: "POST"
            })
        $(idName).prop("disabled", true);
        $(idAmount).prop("disabled", true);
    }
}
function deletePlayer(sOiD){
    $.ajax({
        url: "player_handler.php",
        context: document.body,
        data: {playerID: sOiD, func:"delete"},
        type: "POST"
        }).done(function (data) {
            if (data != "" && data != null) {
                var obj = $.parseJSON(data);
                $("#playersInfo").html(obj.playerboard);
                messageAlert(obj.msg);
            }
        });
}
function editPlayer(sOiD){
    var id="#player_"+sOiD;
    if($(id).is(':disabled')){
        $(id).prop("disabled", false);
    }else{
        var newName = $(id).val();
        $.ajax({
            url: "player_handler.php",
            context: document.body,
            data: {playerID: sOiD, func:"edit",newName:newName},
            type: "POST"
            })
        $(id).prop("disabled", true);
    }
}
function GetItem(sOiD,playerID){
        $.ajax({
            url: "player_handler.php",
            context: document.body,
            data: {itemID: sOiD,playerID:playerID, func:"item"},
            type: "POST"
            }).done(function (data) {
               if (data != "" && data != null) {
                        var obj = $.parseJSON(data);
                        if(obj.itemtxt != "" && obj.itemtxt != null){
                            messageAlert(obj.itemtxt);
                        }
                        $("#playersInfo").html(obj.playerboard);
                        if(obj.playersWon != ""){
                            $("#taskWidow").html(obj.playersWon);
                        }
                        $("#ActiveButton").html(obj.activeBtn);
                    }
                });
}

function addDrink(){
  var addHtml = " <div class='drinkName'><input type='text' id='drink_added' value=''></div><div class='drinkAmount'><input type='text' id='drink_amount_added'></div><div class='drinkSave' onclick='drinkSave();'></div><div class='drinkCancel' onclick='drinkCancel();'></div>";
    $("#idAddDrink").html(addHtml);
}
function addPlayer(){
  var addHtml = " <div class='playerName'><input type='text' id='player_added' value=''></div><div class='playerSave' onclick='playerSave();'></div><div class='playerCancel' onclick='playerCancel();'></div>";
    $("#idAddPlayer").html(addHtml);
}
function drinkCancel(){
    var addHtml = "<div class='addDrink' onclick='addDrink();'><img src='src/img/add.png'></div>";
    $("#idAddDrink").html(addHtml);
}
function playerCancel(){
    var addHtml = "<div class='addPlayer' onclick='addPlayer();'><img src='src/img/add.png'></div>";
    $("#idAddPlayer").html(addHtml);
}
function drinkSave(){
        var newName = $("#drink_added").val();
        var newAmount = $("#drink_amount_added").val();
        $.ajax({
            url: "drink_handler.php",
            context: document.body,
            data: {func:"add",newName:newName,newAmount:newAmount},
            type: "POST"
            }).done(function (data) {
                        if (data != "" && data != null) {
                            var obj = $.parseJSON(data);
                            $("#drinksInfo").html(obj.drinkboard);
                        }
                    });
}

function playerSave(){
        var newName = $("#player_added").val();
        $.ajax({
            url: "player_handler.php",
            context: document.body,
            data: {func:"add",newName:newName},
            type: "POST"
            }).done(function (data) {
                        if (data != "" && data != null) {
                            var obj = $.parseJSON(data);
                            $("#playersInfo").html(obj.playerboard);
                        }
                    });
}

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
function messageAlert(msg){
    var scrollTop =$(window).scrollTop();
    scrollTop=scrollTop-80;
    $("body").css("overflow","hidden");
    $("#msg_messageboard").html(msg);
    $("#fog").css("display","block");
    $("#messageboard").css("display","block");
    $("#messageboard").css("margin-top",scrollTop+"px");

}
function hideAlert(){
    $("#fog").css("display","none");
    $("#messageboard").css("display","none");
    $("body").css("overflow","visible");
}

function showFog(){
    $("#fog").css("display","block");
}
function hideFog(){
    $("#fog").css("display","none");
}
function showItems(playerID){
    var domName= "#items"+playerID;
    $(domName).css("display","block");

}
function hideItems(playerID){
    var domName= "#items"+playerID;
    $(domName).css("display","none");
}