function shooting_base(information) { 
	this.createWall = function() {
		var floor,
			leftWall;
		floor = cc.Sprite.create("");
		floor.setContentSize(cc.SizeMake(320,5));	
		floor.setPosition(cc.p(0,0));
		b2.createPhysicsObject({type:"static",shape:"box",sprite:floor,density:0});

		leftWall = cc.Sprite.create("");
		leftWall.setContentSize(cc.SizeMake(5,568));	
		leftWall.setPosition(cc.p(0.0));
		b2.createPhysicsObject({type:"static",shape:"box",sprite:leftWall,density:0});
	},
	this.createGoalpost = function() {
		var leftPost,
			rightPost,
			topPost;
		
		leftPost = cc.Sprite.create(s_goalPost);
		this.layer.addChild(leftPost);	

		topPost = cc.Sprite.create(s_goalPost);
		this.layer.addChild(topPost);

		rightPost = cc.Sprite.create(s_goalPost);
		this.layer.addChild(rightPost);	
		
		this.goalCheckSprite = cc.Sprite.create(s_goalCheck);
		this.layer.addChild(this.goalCheckSprite);
		if(information.game == 1){
			leftPost.setPosition(cc.p(30,this.layer.size.height -190));
			b2.createPhysicsObject({type:"static",shape:"box",sprite:leftPost,density:0});
			topPost.setPosition(cc.p(30,leftPost.getPosition().y+topPost.getContentSize().height));
			b2.createPhysicsObject({type:"static",shape:"box",sprite:topPost,density:0});
			rightPost.setPosition(cc.p(95,leftPost.getPosition().y));
			b2.createPhysicsObject({type:"static",shape:"box",sprite:rightPost,density:0});		
			this.goalCheckSprite.setPosition(cc.p((leftPost.getPosition().x + rightPost.getPosition().x )/2,leftPost.getPosition().y));
		}
		else if(information.game == 2){
			leftPost.setPosition(cc.p(42,this.layer.size.height -245));
			b2.createPhysicsObject({type:"static",shape:"box",sprite:leftPost,density:0});
			topPost.setPosition(cc.p(42,leftPost.getPosition().y+topPost.getContentSize().height));
			b2.createPhysicsObject({type:"static",shape:"box",sprite:topPost,density:0});
			rightPost.setPosition(cc.p(110,leftPost.getPosition().y));
			b2.createPhysicsObject({type:"static",shape:"box",sprite:rightPost,density:0});		
			this.goalCheckSprite.setPosition(cc.p((leftPost.getPosition().x + rightPost.getPosition().x )/2,leftPost.getPosition().y));
		}
	},
	this.goalCheck = function(ball) { 
		if(!ball.isShoot()) return;
		var x = this.goalCheckSprite.getPosition().x - this.goalCheckSprite.getContentSize().width/2;
		var y = this.goalCheckSprite.getPosition().y - this.goalCheckSprite.getContentSize().height/2;
	    var ballPosition = this.layer.ball.sprite_basketball().getPosition();
	    if(x<ballPosition.x && x+this.goalCheckSprite.getContentSize().width  > ballPosition.x
	    	&& y<ballPosition.y && y+this.goalCheckSprite.getContentSize().height > ballPosition.y){
		    return 1;
	    }
	    else if(ballPosition.y < 50) return 0;
	}
	this.layer = information.layer;
	this.createWall();
	this.createGoalpost();
}