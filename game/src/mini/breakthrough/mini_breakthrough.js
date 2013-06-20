var mini_breakthrough_layer = cc.Layer.extend({
    init:function () {
        this._super();
        this.setTouchEnabled(true);
        b2.initWorld();

        this.size = cc.Director.getInstance().getWinSize();
        this.createBackground();
        this.createZone();
        this.createPlayer();
		return true;
    },
    createPlayer:function() {
	    this.player_first = new players({layer:this,speed:window.player.speed/10});
        this.player_first.createPlayers(0);
        
        this.player_second = new players({layer:this,speed:window.player.speed/10 + 0.5});
        this.player_second.createPlayers(1);
        
        this.player_third = new players({layer:this,speed:window.player.speed/10 + 0.3});
        this.player_third.createPlayers(2);
        
        this.opponentArray = [];
        this.opponentArray.push(this.player_second);
        this.opponentArray.push(this.player_third);
    },
    createBackground:function(){
	  	var sprite_background = cc.Sprite.create(s_intercept_background);
	  	sprite_background.setPosition(cc.p(this.size.width/2,this.size.height/2));
	  	this.addChild(sprite_background);
    },
    createZone:function() {
	  	var sprite_startZone = cc.Sprite.create(s_startingZone);
	  	sprite_startZone.setPosition(cc.p(160,50));
	  	this.addChild(sprite_startZone);

 	  	var sprite_arrivalZone = cc.Sprite.create(s_arrivalZone);
 	  	sprite_arrivalZone.setPosition(cc.p(160,518));
 	  	this.addChild(sprite_arrivalZone);
 	  	
 	  	this.schedule(this.checkPlayerStarting);
    },
    checkPlayerStarting:function() {
	    if(this.player_first.getPosition().y > 100 ){
		    this.unschedule(this.checkPlayerStarting);
		    this.player_second.ai(1);
		    this.player_third.ai(2);
		    this.schedule(this.checkPlayerArrival);
		    this.schedule(this.checkPlayerCollision);
	    }
    },
    checkPlayerArrival:function() {
	    if(this.player_first.getPosition().y > 468 ){
		    this.unschedule(this.checkPlayerArrival);
		    this.unschedule(this.checkPlayerCollision);
		    this.player_second.ai(0);
		    this.player_third.ai(0);
		  
		    cc.AudioEngine.getInstance().playEffect(e_success, false);
		    this.result = {goal:true};
		    var success = cc.Sprite.create(s_success);
	        success.setPosition(this.size.width + this.size.width/2 , this.size.height/2);
	        success.runAction(
	        cc.Sequence.create(
	        cc.MoveTo.create(1,cc.p(this.size.width/2,this.size.height/2)),
	        cc.DelayTime.create(0.5),
	        cc.MoveTo.create(1,cc.p(-this.size.width,this.size.height/2)),
	        cc.CallFunc.create(this.changeScene,this)));
	        this.addChild(success);
	    }
    },
    checkPlayerCollision:function() {
	  	for(var i=0,length = this.opponentArray.length ; i<length ; i++){
		  	var opponent = this.opponentArray[i];
		  	if(cc.pLength(cc.pSub(this.player_first.getPosition(), opponent.getPosition()))+3 < (this.player_first.playerSkin().getContentSize().width+opponent.playerSkin().getContentSize().width)/2){
			  	this.unschedule(this.checkPlayerArrival);
			  	this.unschedule(this.checkPlayerCollision);
			  	this.player_second.ai(0);
			  	this.player_third.ai(0);
		    
			  	cc.AudioEngine.getInstance().playEffect(e_fail, false);
			  	this.result = {goal:false};
			  	var fail = cc.Sprite.create(s_fail);
			  	fail.setPosition(this.size.width + this.size.width/2 , this.size.height/2);
			  	fail.runAction(
			  	cc.Sequence.create(
			  	cc.MoveTo.create(1,cc.p(this.size.width/2,this.size.height/2)),
			  	cc.DelayTime.create(0.5),
			  	cc.MoveTo.create(1,cc.p(-this.size.width,this.size.height/2)),
			  	cc.CallFunc.create(this.changeScene,this)));
	        	this.addChild(fail);
		  	}
	  	}  
    },
    changeScene:function() { 
		location.replace('http://dadream.org/');  
	},
    onTouchesBegan:function (touch, event) {
    	this.player_first.setDestinations(touch[0].getLocation());
    },
	onTouchesMoved:function(touch,event){
	    this.player_first.setDestinations(touch[0].getLocation());
	},
    onTouchesEnded:function (touch,event){
	   
	},
});

var mini_breakthrough_scene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new mini_breakthrough_layer();
        this.addChild(layer);
        layer.init();
    }
});