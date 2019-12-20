var KEY_ENTER=13;
website(document).ready(function(){
	var websiteinput=website(".chat-input-ironman-rajuharry")
		,websitesendButton=website(".chat-send-ironman-rajuharry")
		,websitemessagesContainer=website(".chat-messages-ironman-rajuharry")
		,websitemessagesList=website(".chat-messages-list-ironman-rajuharry")
		,websiteeffectContainer=website(".chat-effect-container-ironman-rajuharry")
		,websiteinfoContainer=website(".chat-info-container-ironman-rajuharry")

		,messages=0
		,bleeding=100
		,isFriendTyping=false
		,incomingMessages=0
		,lastMessage=""
	;
	
	var lipsum="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

	
	function gooOff(){
		setFilter('none');
	}
	function setFilter(value){
		websiteeffectContainer.css({
			webkitFilter:value,
			mozFilter:value,
			filter:value,
		});
	}

	function addMessage(message,self){
		var websitemessageContainer=website("<li/>")
			.addClass('chat-message-ironman-rajuharry '+(self?'chat-message-self-ironman-rajuharry':'chat-message-friend-ironman-rajuharry'))
			.appendTo(websitemessagesList)
		;
		var websitemessageBubble=website("<div/>")
			.addClass('chat-message-bubble-ironman-rajuharry')
			.appendTo(websitemessageContainer)
		;
		websitemessageBubble.text(message);

		var oldScroll=websitemessagesContainer.scrollTop();
		websitemessagesContainer.scrollTop(9999999);
		var newScroll=websitemessagesContainer.scrollTop();
		var scrollDiff=newScroll-oldScroll;
		TweenMax.fromTo(
			websitemessagesList,0.4,{
				y:scrollDiff
			},{
				y:0,
				ease:Quint.easeOut
			}
		);

		return {
			websitecontainer:websitemessageContainer,
			websitebubble:websitemessageBubble
		};
	}
	function sendMessage(){
		var message=websiteinput.text();
		
		if(message=="") return;
		
		lastMessage=message;

		var messageElements=addMessage(message,true)
			,websitemessageContainer=messageElements.websitecontainer
			,websitemessageBubble=messageElements.websitebubble
		;

		var oldInputHeight=website(".chat-input-bar-ironman-rajuharry").height();
		websiteinput.text('');
		updateChatHeight();
		var newInputHeight=website(".chat-input-bar-ironman-rajuharry").height();
		var inputHeightDiff=newInputHeight-oldInputHeight

		var websitemessageEffect=website("<div/>")
			.addClass('chat-message-effect-ironman-rajuharry')
			.append(websitemessageBubble.clone())
			.appendTo(websiteeffectContainer)
			.css({
				left:websiteinput.position().left-12,
				top:websiteinput.position().top+bleeding+inputHeightDiff
			})
		;


		var messagePos=websitemessageBubble.offset();
		var effectPos=websitemessageEffect.offset();
		var pos={
			x:messagePos.left-effectPos.left,
			y:messagePos.top-effectPos.top
		}

		var websitesendIcon=websitesendButton.children("i");
		TweenMax.to(
			websitesendIcon,0.15,{
				x:30,
				y:-30,
				force3D:true,
				ease:Quad.easeOut,
				onComplete:function(){
					TweenMax.fromTo(
						websitesendIcon,0.15,{
							x:-30,
							y:30
						},
						{
							x:0,
							y:0,
							force3D:true,
							ease:Quad.easeOut
						}
					);
				}
			}
		);

		//gooOn();

		
		TweenMax.from(
			websitemessageBubble,0.8,{
				y:-pos.y,
				ease:Sine.easeInOut,
				force3D:true
			}
		);

		var startingScroll=websitemessagesContainer.scrollTop();
		var curScrollDiff=0;
		var effectYTransition;
		var setEffectYTransition=function(dest,dur,ease){
			return TweenMax.to(
				websitemessageEffect,dur,{
					y:dest,
					ease:ease,
					force3D:true,
					onUpdate:function(){
						var curScroll=websitemessagesContainer.scrollTop();
						var scrollDiff=curScroll-startingScroll;
						if(scrollDiff>0){
							curScrollDiff+=scrollDiff;
							startingScroll=curScroll;

							var time=effectYTransition.time();
							effectYTransition.kill();
							effectYTransition=setEffectYTransition(pos.y-curScrollDiff,0.8-time,Sine.easeOut);
						}
					}
				}
			);
		}

		effectYTransition=setEffectYTransition(pos.y,0.8,Sine.easeInOut);
		
		// effectYTransition.updateTo({y:800});

		TweenMax.from(
			websitemessageBubble,0.6,{
				delay:0.2,
				x:-pos.x,
				ease:Quad.easeInOut,
				force3D:true
			}
		);
		TweenMax.to(
			websitemessageEffect,0.6,{
				delay:0.2,
				x:pos.x,
				ease:Quad.easeInOut,
				force3D:true
			}
		);

		TweenMax.from(
			websitemessageBubble,0.2,{
				delay:0.65,
				opacity:0,
				ease:Quad.easeInOut,
				onComplete:function(){
					TweenMax.killTweensOf(websitemessageEffect);
					websitemessageEffect.remove();
					if(!isFriendTyping)
						gooOff();
				}
			}
		);

		messages++;

		if(Math.random()<0.65 || lastMessage.indexOf("?")>-1 || messages==1) getReply();
	}
	function getReply(){
		if(incomingMessages>2) return;
		incomingMessages++;
		var typeStartDelay=1000+(lastMessage.length*40)+(Math.random()*1000);
		setTimeout(friendIsTyping,typeStartDelay);

		var source=lipsum.toLowerCase();
		source=source.split(" ");
		var start=Math.round(Math.random()*(source.length-1));
		var length=Math.round(Math.random()*13)+1;
		var end=start+length;
		if(end>=source.length){
			end=source.length-1;
			length=end-start;
		}
		var message="";
		for (var i = 0; i < length; i++) {
			message+=source[start+i]+(i<length-1?" ":"");
		};
		message+=Math.random()<0.4?"?":"";
		message+=Math.random()<0.2?" :)":(Math.random()<0.2?" :(":"");

		var typeDelay=300+(message.length*50)+(Math.random()*1000);

		setTimeout(function(){
			receiveMessage(message);
		},typeDelay+typeStartDelay);

		setTimeout(function(){
			incomingMessages--;
			if(Math.random()<0.1){
				getReply();
			}
			if(incomingMessages<=0){
				friendStoppedTyping();
			}
		},typeDelay+typeStartDelay);
	}
	function friendIsTyping(){
		if(isFriendTyping) return;

		isFriendTyping=true;

		var websitedots=website("<div/>")
			.addClass('chat-effect-dots-ironman-rajuharry')
			.css({
				top:-30+bleeding,
				left:10
			})
			.appendTo(websiteeffectContainer)
		;
		for (var i = 0; i < 100; i++) {
			/*var websitedot=website("<div/>")
				.addClass("chat-effect-dot-ironman-rajuharry")
				.css({
					left:i*20
				})
				.appendTo(websitedots)
			;
			TweenMax.to(websitedot,0.3,{
				delay:-i*0.1,
				y:30,
				yoyo:true,
				repeat:-1,
				ease:Quad.easeInOut
			})*/
		};

		var websiteinfo=website("<div/>")
			.addClass("chat-info-typing-ironman-rajuharry")
			.text("Your friend is typing...")
			.css({
				transform:"translate3d(0,30px,0)"
			})
			.appendTo(websiteinfoContainer)

		TweenMax.to(websiteinfo, 0.3,{
			y:0,
			force3D:true
		});

		//gooOn();
	}

	function friendStoppedTyping(){
		if(!isFriendTyping) return

		isFriendTyping=false;

		var websitedots=websiteeffectContainer.find(".chat-effect-dots-ironman-rajuharry");
		TweenMax.to(websitedots,0.3,{
			y:40,
			force3D:true,
			ease:Quad.easeIn,
		});

		var websiteinfo=websiteinfoContainer.find(".chat-info-typing-ironman-rajuharry");
		TweenMax.to(websiteinfo,0.3,{
			y:30,
			force3D:true,
			ease:Quad.easeIn,
			onComplete:function(){
				websitedots.remove();
				websiteinfo.remove();

				gooOff();
			}
		});
	}
	function receiveMessage(message){
		var messageElements=addMessage(message,false)
			,websitemessageContainer=messageElements.websitecontainer
			,websitemessageBubble=messageElements.websitebubble
		;

		TweenMax.set(websitemessageBubble,{
			transformOrigin:"60px 50%"
		})
		TweenMax.from(websitemessageBubble,0.4,{
			scale:0,
			force3D:true,
			ease:Back.easeOut
		})
		TweenMax.from(websitemessageBubble,0.4,{
			x:-100,
			force3D:true,
			ease:Quint.easeOut
		})
	}

	function updateChatHeight(){
		websitemessagesContainer.css({
			height:460-website(".chat-input-bar-ironman-rajuharry").height()
		});
	}

	websiteinput.keydown(function(event) {
		if(event.keyCode==KEY_ENTER){
			event.preventDefault();
			sendMessage();
		}
	});
	websitesendButton.click(function(event){
		event.preventDefault();
		sendMessage();
		// websiteinput.focus();
	});
	websitesendButton.on("touchstart",function(event){
		event.preventDefault();
		sendMessage();
		// websiteinput.focus();
	});

	websiteinput.on("input",function(){
		updateChatHeight();
	});

	//gooOff();
	updateChatHeight();
    //friendIsTyping();
})