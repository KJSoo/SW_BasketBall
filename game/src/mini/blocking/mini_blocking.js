var mini_blocking_layer = cc.Layer.extend({
    init:function () {
        this._super();
        this.setTouchEnabled(true);
        b2.initWorld();

        this.size = cc.Director.getInstance().getWinSize();
        
        this.createBackground();
		this.scheduleUpdate();
				
		//this.ball = new ball({layer:this, position:cc.p(700,250),impulse:cc.p(-250,310)});		
		this.ball = new ball({layer:this, position:cc.p(700,300),impulse:cc.p(-200,110)});		
		this.player = new intercept_players({layer:this, playerSkin:s_blocking_playerSkin,position:cc.p(180,150)});
		
		this.base = new shooting_base({layer:this,game:2});
		
		this.trackingPoint = cc.Sprite.create(s_blocking_point);
		this.trackingPoint.setAnchorPoint(cc.p(1,0.5));
		this.trackingPoint.setPositionX(320);
		this.addChild(this.trackingPoint);
		
		this.schedule(this.check);
		this.schedule(this.shoot,1 + Math.random()*2);
		return true;
    },
    createBackground:function(){
	    var sprite_background = cc.Sprite.create(s_blocking_backroung);
        sprite_background.setPosition(cc.p(this.size.width/2,this.size.height/2));
        this.addChild(sprite_background);
        
        var sprite_background_goalpost_background = cc.Sprite.create(s_blocking_goalpost_background);
        sprite_background_goalpost_background.setPosition(cc.p(this.size.width/2,this.size.height/2));
        this.addChild(sprite_background_goalpost_background);

	},
	shoot:function() {
		this.ball.shootingBall();
	},
	check:function() {
		this.trackingPoint.setPositionY(this.ball.sprite_basketball().getPosition().y);
		switch(this.base.goalCheck(this.ball)){
	        case 0:
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
	        	this.unschedule(this.check);
	        	break;
	        case 1:
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
     		    this.unschedule(this.check);
	        	break;
        }	
	},
	changeScene:function() { 
		location.replace('http://dadream.org/');  
	},
	onTouchesBegan:function (touch, event) {
		if(!this.jump){
			this.jump = 1;
			this.player.jump();
		}
    },
	onTouchesMoved:function(touch,event){
	},
    onTouchesEnded:function (touch,event){
	   
	},
	
	update: function (dt) {
        b2.simulate();
    },	
		
});

var mini_blocking_scene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new mini_blocking_layer();
        this.addChild(layer);
        layer.init();
    }
});