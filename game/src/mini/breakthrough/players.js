var players = function(information) {
	var playerSkin,
		type,
		moveSpeed,
		moveAction,
		layer,
		destination,
		aiLevel;
	
		this.init = function() {
			layer = information.layer;
			type = "0";
			moveSpeed = information.speed || 1.5; // 
			//this.createPlayers();
		},
		this.playerSkin = function(){
			return playerSkin;	
		},
		this.getPosition = function() {
			return playerSkin.getPosition();
		},
		this.createPlayers = function(position){
			//type = "s_playerSkin_"+type;
			if(position == 0){
				playerSkin = cc.Sprite.create(s_playerSkin_0);
				playerSkin.setPosition(cc.p(160,50));
			}
			else if(position == 1){
				playerSkin = cc.Sprite.create(s_playerSkin_1);
				playerSkin.setPosition(cc.p((Math.random()*1000)%320,220));
			}
			else if(position == 2){
				playerSkin = cc.Sprite.create(s_playerSkin_1);
				playerSkin.setPosition(cc.p((Math.random()*1000)%320,340));
			}
			
			layer.addChild(playerSkin);
			this.setDestinations(playerSkin.getPosition());
			playerSkin.schedule(this.movePlayers);	
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
		this.setDestinations = function(destinationPosition){
			destination = destinationPosition;
		},
		this.trackingPlayer = function(){
			var user = layer.player_first.playerSkin().getPosition();
			if(aiLevel == 1)
				destination.x = user.x;
			else if(aiLevel == 2)
				destination = user;
			else
				destination = playerSkin.getPosition();
		},
		this.ai = function(level){
			aiLevel = level;
			playerSkin.unschedule(this.trackingPlayer);	
			playerSkin.schedule(this.trackingPlayer,0.5);	
		}
		
		this.init();
}	