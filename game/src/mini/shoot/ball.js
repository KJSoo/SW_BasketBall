var ball = function(information) { 
	var sprite_basketball,
		sprite_fake_basketball,
		basketBallFirstPosition,
		lastPosition = cc.p(0,0),
		courseArray = [],
		sprite_course,
		layer,
		isShoot = false;
		
	this.init = function(shootLayer) {
		this.setLayer();
		this.createBasketball();
		return true;
	},
	this.basketBallFirstPosition = function() { 
		return basketBallFirstPosition;
	},
	this.sprite_basketball = function() {
		return sprite_basketball;
	},
	this.lastPosition = function(){
		return lastPosition;
	},
	this.isShoot = function() {
		return isShoot;	
	},
	this.setLayer = function() {
		layer = information.layer;	
	},
	this.createBasketball = function(){
			basketBallFirstPosition = information.position || cc.PointMake(200 + (Math.random()*1000)%80, 150 + (Math.random()*1000)%100);
			sprite_basketball = cc.Sprite.create(s_backetball);
			sprite_basketball.setPosition(basketBallFirstPosition);
				
			sprite_fake_basketball = cc.Sprite.create(s_backetball);
			layer.addChild(sprite_basketball,100,100);	
	},
	this.moveBasketball = function(position) {
		sprite_basketball.setPosition(position);
		if(cc.pLength(cc.pSub(sprite_basketball.getPosition(), lastPosition)) > 2){
	       	 lastPosition = sprite_basketball.getPosition();
	       	 this.fakeShootingBall();
	      }
	},
	this.shootingBall = function(){
		if(isShoot) return;
		this.createBoxObject(sprite_basketball,{type:"dynamic",shape:"circle",density:12,restitution: 0.6});
		var vector = cc.pSub(basketBallFirstPosition, sprite_basketball.getPosition()),
		    impulse = information.impulse || cc.pMult(vector, window.player.power),
		    bPos = sprite_basketball.body.GetWorldCenter();
		    sprite_basketball.body.ApplyImpulse(impulse, bPos);
		this.removeBallTrack();
		isShoot = isShoot || true;	
	},
		
	this.createBoxObject = function(setSprite,description) {
    b2.createPhysicsObject({
            type: description.type,
            shape: description.shape,
            sprite: setSprite,
            radius: description.radius,
            density: description.density,
            restitution: description.restitution,
            data:description.data
        });
        },
        
        this.fakeShootingBall = function(){
	        if(isShoot) return;
	   		this.removeBallTrack();
			sprite_fake_basketball.setPosition(cc.p(sprite_basketball.getPosition().x,sprite_basketball.getPosition().y));
			sprite_fake_basketball.setTag(1000);
	        this.createBoxObject(sprite_fake_basketball,{type:"dynamic",shape:"circle",density:12,restitution: 0.6});
		   		var vector = cc.pSub(basketBallFirstPosition, sprite_fake_basketball.getPosition()),
		            impulse = cc.pMult(vector, window.player.power),
		            bPos = sprite_fake_basketball.body.GetWorldCenter();
		    sprite_fake_basketball.body.ApplyImpulse(impulse, bPos);	
		    for(var i = 0 ; i < window.player.pace; i++){
	   			b2.fakeSimulate();  
	   			this.fakeShootingBallTrack();
	   		}
	   		b2.removeFakeBall();
    	},

    	this.fakeShootingBallTrack = function(){
		 	sprite_course = cc.Sprite.create(s_miniCourse);
		 	sprite_course.setPosition(sprite_fake_basketball.getPosition());
		    layer.addChild(sprite_course);	
		    courseArray.push(sprite_course);
		},

		this.removeBallTrack = function(){
			for(var i = courseArray.length; i >= 0 ; i--){
				var body = courseArray[i];
				layer.removeChild(body,true);	
			}
			while(courseArray.pop()){}
		}
		this.init(information.layer);
}