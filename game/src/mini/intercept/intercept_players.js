var intercept_players = function(information){
	var playerSkin,
		layer,
		destination,
		moveSpeed;
	this.init = function(){
		layer = information.layer;
		moveSpeed = information.speed || 0.5;
		this.createPlayer();
	},
	this.playerSkin = function(){
			return playerSkin;	
		},
	this.getPosition = function() {
			return playerSkin.getPosition();
	},
	this.createPlayer = function(){
		playerSkin = cc.Sprite.create(information.playerSkin);
		this.setPlayerPosition();
		layer.addChild(playerSkin);
	},
	this.setPlayerPosition = function(){
		information.position = information.position || cc.p(0,0);
		playerSkin.setPosition(information.position);	
		this.setDestinations(playerSkin.getPosition());
		playerSkin.schedule(this.movePlayers);	
	},
	this.setDestinations = function(destinationPosition){
			destination = destinationPosition;
	},
	this.movePlayers = function(){
			var length = Math.pow(destination.x - playerSkin.getPosition().x,2) + Math.pow(destination.y - playerSkin.getPosition().y,2);
			length = Math.pow(length,0.5);
			if(playerSkin.getPosition().x - destination.x > 3 || playerSkin.getPosition().x - destination.x < -3){
				if(playerSkin.getPosition().x < destination.x )
					playerSkin.setPositionX(playerSkin.getPosition().x+moveSpeed);
				else
					playerSkin.setPositionX(playerSkin.getPosition().x-moveSpeed);
			}
			if(playerSkin.getPosition().y - destination.y > 3 || playerSkin.getPosition().y - destination.y < -3){
				if(playerSkin.getPosition().y < destination.y)
					playerSkin.setPositionY(playerSkin.getPosition().y+moveSpeed);
				else
					playerSkin.setPositionY(playerSkin.getPosition().y-moveSpeed);
			}
	},
	this.ai = function(){
		if(information.ai % 2 < 1){
			this.setDestinations(cc.p(playerSkin.getPosition().x+140,playerSkin.getPosition().y));
		}
		else
			this.setDestinations(cc.p(playerSkin.getPosition().x-140,playerSkin.getPosition().y));
	},
	
	this.jump = function() {
		b2.createPhysicsObject({
            type: "dynamic",
            shape: "box",
            sprite: playerSkin,
            restitution : 0,
            density : 400000
        });
		var bPos = playerSkin.body.GetWorldCenter();
		    playerSkin.body.ApplyImpulse(cc.p(0,1000000*window.player.jump), bPos);
	}
	
	this.init();
}