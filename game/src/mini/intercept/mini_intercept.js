var mini_intercept_layer = cc.Layer.extend({
    init:function () {
        this._super();
        this.setTouchEnabled(true);
        
        this.size = cc.Director.getInstance().getWinSize();
                
        this.createBackground();
		this.createPlayer();
		this.schedule(this.moveBall);
		return true;
    },
    createBackground:function(){
	    var sprite_background = cc.Sprite.create(s_intercept_background);
        sprite_background.setPosition(cc.p(this.size.width/2,this.size.height/2));
        this.addChild(sprite_background);
	},
	createPlayer:function(){
		this.userPlayer = new intercept_players({layer:this,playerSkin:s_intercept_playerSkin_0,position:cc.p(160,568/2),speed:window.player.speed / 20});
		
		this.firstPlayer = new intercept_players({layer:this,playerSkin:s_intercept_playerSkin_1,position:cc.p(160,450+(Math.random()*1000)%100),speed:0.5,ai:Math.random()*100,speed:1.5});
		this.secondPlayer = new intercept_players({layer:this,playerSkin:s_intercept_playerSkin_1,position:cc.p(160,50+(Math.random()*1000)%100),speed:0.5,ai:Math.random()*100,speed:2.0});

		this.ball = cc.Sprite.create(s_intercept_basketBall);
		this.ball.setPosition(this.firstPlayer.getPosition());
		this.addChild(this.ball);
	},
	moveBall:function(){
		this.ball.setPosition(this.firstPlayer.getPosition());
	},
	pass:function(){
		this.unschedule(this.pass);
		this.unschedule(this.moveBall);
		this.firstPlayer.setDestinations(this.firstPlayer.getPosition());
    	this.secondPlayer.setDestinations(this.secondPlayer.getPosition());
		this.ball.runAction(cc.MoveTo.create(1.5, this.secondPlayer.getPosition()));
		this.schedule(this.check);
	},
	check:function(){
		if(cc.pLength(cc.pSub(this.userPlayer.getPosition(), this.ball.getPosition())) < (this.userPlayer.playerSkin().getContentSize().width+this.ball.getContentSize().width)/2){
			  	this.ball.stopAllActions();
			  	this.unschedule(this.check);
			  	this.result = {goal:true};
			  	cc.AudioEngine.getInstance().playEffect(e_success, false);
	        	var success = cc.Sprite.create(s_success);
	        	success.setPosition(this.size.width + this.size.width/2 , this.size.height/2);
	        	success.runAction(
	        	cc.Sequence.create(
	        	cc.MoveTo.create(1,cc.p(this.size.width/2,this.size.height/2)),
	        	cc.DelayTime.create(0.5),
	        	cc.MoveTo.create(1,cc.p(-this.size.width,this.size.height/2)),
	        	cc.CallFunc.create(this.changeScene,this)));
	        	this.addChild(success);
		 }else if(cc.pLength(cc.pSub(this.secondPlayer.getPosition(), this.ball.getPosition())) < (this.secondPlayer.playerSkin().getContentSize().width+this.ball.getContentSize().width)/2){
			 	this.ball.stopAllActions();
			  	this.unschedule(this.check);
			  	this.result = {goal:false};
			  	cc.AudioEngine.getInstance().playEffect(e_fail, false);
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
	},
	changeScene:function() { 
		location.replace('http://dadream.org/');  
	},
	onTouchesBegan:function (touch, event) {
    	this.userPlayer.setDestinations(touch[0].getLocation());
  		if(!this.temp){
  			this.firstPlayer.ai();
  			this.secondPlayer.ai();
  			this.schedule(this.pass,0.2 + Math.random()*2);
  			console.log(Math.random());
  		}
  		this.temp = 1;
    },
	onTouchesMoved:function(touch,event){
	    this.userPlayer.setDestinations(touch[0].getLocation());
	},
    onTouchesEnded:function (touch,event){
	   
	},
});

var mini_intercept_scene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new mini_intercept_layer();
        this.addChild(layer);
        layer.init();
    }
});