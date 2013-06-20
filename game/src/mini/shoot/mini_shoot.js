var mini_shoot_layer = cc.Layer.extend({
    init:function () {
        this._super();
        this.setTouchEnabled(true);
        b2.initWorld();
        
        this.size = cc.Director.getInstance().getWinSize();
        
        this.createBackground();
		this.scheduleUpdate();
		
		//ball.init(this);
		this.ball = new ball({layer:this});		
		this.base = new shooting_base({layer:this,game:1});
		
		return true;
    },
    createBackground:function(){
	    var sprite_background = cc.Sprite.create(s_shooting_background);
        sprite_background.setPosition(cc.p(this.size.width/2,this.size.height/2));
        this.addChild(sprite_background);
       
        var sprite_background_goalpost_background = cc.Sprite.create(s_shooting_goalpost_background);
        sprite_background_goalpost_background.setPosition(cc.p(this.size.width/2,this.size.height/2));
        this.addChild(sprite_background_goalpost_background);
        
        var sprite_post = cc.Sprite.create(s_post);
        sprite_post.setPosition(cc.p(this.size.width/2,this.size.height/2));
        this.addChild(sprite_post,200,200);
	},
	check:function() {
		switch(this.base.goalCheck(this.ball)){
	        case 1:
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
	        	this.unschedule(this.check);
	        	break;
	        case 0:
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
     		    this.unschedule(this.check);
	        	break;
	        
        }	
	},
	changeScene:function() { 
		location.replace('http://dadream.org/');  
	},
	onTouchesBegan:function (touch, event) {
    },
	onTouchesMoved:function(touch,event){
		var currPoint = touch[0].getLocation(),
            vector = cc.pSub(currPoint, this.ball.basketBallFirstPosition()),
            radius = cc.pLength(vector),
            angle = cc.pToAngle(vector);
            
        angle = angle < 0 ? (Math.PI * 2) + angle : angle;
        radius = Math.min(40, Math.max(radius, 10))
        if (angle <= 40 && angle >= 20) {
            radius = 10;
        }
        this.ball.moveBasketball(cc.pAdd(this.ball.basketBallFirstPosition(), cc.p(radius * Math.cos(angle), radius * Math.sin(angle))));  
	},
    onTouchesEnded:function (touch,event){
    	if(!this.ball.isShoot()){
	    	this.ball.shootingBall();
	    	this.schedule(this.check);
	    }
	   
	},
	update: function (dt) {
        b2.simulate();
    },	
		
});

var mini_shoot_scene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new mini_shoot_layer();
        this.addChild(layer);
        layer.init();
    }
});