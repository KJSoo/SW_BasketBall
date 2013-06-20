var b2 = (function () {
    var self = this,
        world,
        enableDebugDraw = false,
        bodies = [],
        PTMRatio = 30.0,
        toWorld = function (n) {
            return n / PTMRatio;
        },
        toScreen = function (n) {
            return n * PTMRatio;
        },
        b2AngleToCCRotation = function (n) {
            return (-1 * cc.RADIANS_TO_DEGREES(n));
        },
        CCRotationToB2Angle = function (n) {
            return cc.DEGREES_TO_RADIANS(-1 * n);
        };

    var contactListener = new Box2D.Dynamics.b2ContactListener();
    contactListener.BeginContact = function (contact) {
    	 var bodyA = contact.GetFixtureA()
            .GetBody(),
            bodyB = contact.GetFixtureB()
                .GetBody(),
            aData = bodyA.GetUserData(),
            bData = bodyB.GetUserData();
            
            aData && aData.setCollision(true);
            bData && bData.setCollision(true);
    };
    contactListener.EndContact = function (contact) {};
    contactListener.PreSolve = function (contact, oldManifold) {};
    contactListener.PostSolve = function (contact, impulse) {
    };

    return {
        toWorld: function (n) {
            return toWorld(n);
        },
        toScreen: function (n) {
            return toScreen(n);
        },
        initWorld: function () {
            world = new Box2D.Dynamics.b2World(new Box2D.Common.Math.b2Vec2(0, - 10), true);
            world.SetContinuousPhysics(true);
            world.SetContactListener(contactListener);
            bodies = [];
        },
        createPhysicsObject: function (desc) {
            var bodyDef = new Box2D.Dynamics.b2BodyDef(),
                anch = desc.sprite.getAnchorPointInPoints(),
                anchPoint = cc.p(anch.x, anch.y),
                position = desc.sprite.getPosition(),
                size = desc.sprite.getContentSize(),
                center = cc.p(position.x - anchPoint.x + size.width / 2, position.y - anchPoint.y + size.height / 2);

			bodyDef.type = desc.type;
			if(desc.type === "static")
				bodyDef.type = Box2D.Dynamics.b2Body.b2_staticBody;
			else if(desc.type === "dynamic")
				bodyDef.type = Box2D.Dynamics.b2Body.b2_dynamicBody;
			else
				bodyDef.type = Box2D.Dynamics.b2Body.b2_kinematicBody;
				
            bodyDef.position.Set(toWorld(center.x), toWorld(center.y));
            bodyDef.angle = CCRotationToB2Angle(desc.sprite.getRotation());
            
            var fixDef = new Box2D.Dynamics.b2FixtureDef();
            switch (desc.shape) {
            case "circle":
                fixDef.shape = new Box2D.Collision.Shapes.b2CircleShape(toWorld(desc.radius || (size.height / 2)));
                break;
            case "box":
                fixDef.shape = new Box2D.Collision.Shapes.b2PolygonShape();
                fixDef.shape.SetAsBox(toWorld(size.width) / 2, toWorld(size.height) / 2);
                break;
            }

            fixDef.density = desc.density || 1;
            fixDef.friction = desc.friction || 0.5;
            fixDef.restitution = desc.restitution || 0.1;

            var body = world.CreateBody(bodyDef);
            body.CreateFixture(fixDef);
            
            desc.data && body.SetUserData(desc.data);
            
            body.sprite = desc.sprite;
            desc.sprite.body = body;

            bodies.push(body);
        },
        fakeSimulate: function(){
        	var body,
                bPos,
                bAngle;
          	for (var i = 0; i < bodies.length; i++) {
                body = bodies[i];
                if(body.sprite.getTag() == 1000){
	                bPos = body.GetPosition(),
	                bAngle = body.GetAngle();
	                break;
                }   
            }
           for (var i = 0; i < 5; i++) {
	            world.Step(1 / 60,10,10);
               
                anch = body.sprite.getAnchorPointInPoints(),
                    anchPoint = cc.p(anch.x, anch.y),
                    position = body.sprite.getPosition(),
                    contentSize = body.sprite.getContentSize(),
                    size = {
                        width: contentSize.width,
                        height: contentSize.height
                    };

                body.sprite.setPosition(cc.p(toScreen(bPos.x) + anchPoint.x - size.width / 2, toScreen(bPos.y) + anchPoint.y - size.height / 2));
                body.sprite.setRotation(b2AngleToCCRotation(bAngle));
                world.ClearForces();
            }
        },
        removeFakeBall: function(){
          	for (var i = 0; i < bodies.length; i++) {
                var body = bodies[i];
                if(body.sprite.getTag() == 1000){
                	bodies.pop(body);
	                world.DestroyBody(body);
	                }
            }	 
        },
        simulate: function () {
          world.Step(1 / 60,10,10);

            for (var i = 0; i < bodies.length; i++) {
                var body = bodies[i],
                    bodyData = body.GetUserData(),
                    bPos = body.GetPosition(),
                    bAngle = body.GetAngle();
                   
                anch = body.sprite.getAnchorPointInPoints(),
                    anchPoint = cc.p(anch.x, anch.y),
                    position = body.sprite.getPosition(),
                    contentSize = body.sprite.getContentSize(),
                    size = {
                        width: contentSize.width,
                        height: contentSize.height
                    };

                body.sprite.setPosition(cc.p(toScreen(bPos.x) + anchPoint.x - size.width / 2, toScreen(bPos.y) + anchPoint.y - size.height / 2));
                body.sprite.setRotation(b2AngleToCCRotation(bAngle));
            }

            world.ClearForces();
        },
    };
}());