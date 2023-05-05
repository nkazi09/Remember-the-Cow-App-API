/*
Nadia Kazi
The purpose of this page is to allow the user create an todolist 
and allows the user to add/remove, reorder the items in the list  
as desired.
*/

"use strict";
// calls event handeler functions
document.observe("dom:loaded", function() {
	if($("add")) {		
		myAjaxRequest("get", undefined, ajaxGotList);
		$("add").observe("click", addText);
		$("delete").observe("click", deleteText);
	}
});

// it takes methodType, paramType and ajaxList as parameter
// and makes an ajex request whenever the list is built or
// modified. 
function myAjaxRequest(methodType, paramType, ajaxtList) {
	new Ajax.Request("webservice.php", {
		method: methodType,
		parameters: {todolist: paramType},
		onSuccess: ajaxtList,
		onFailure: myAjaxFailure,
		onException: myAjaxFailure
	});
}

// The method gets called whenever an get request is made. 
function ajaxGotList(ajax) {
	if(ajax.responseText) {
		var data = JSON.parse(ajax.responseText);
		for(var i = 0; i < data.items.length; i++) {
			var li = document.createElement("li");	// creates the bulleted list
			li.id = "item" + "_" + ($$("#todolist li").length);
			li.innerHTML = data.items[i];	
			$("todolist").appendChild(li);	// adds the items in the bulleted list
		}
		visualEffect();
	}
}

function visualEffect() {
	Sortable.create("todolist", {
		onUpdate: listUpdate	
	});	
} 

// whenever an ajex request is failed the method gets called. 
// For any other kids of error such as error 404 etc, the method outputs 
// a massage explaning the error that occured.
function myAjaxFailure(ajax, exception) {
	var div = document.createElement("div");
	div.id = "error";	// creates a div with an id called error
	$("main").appendChild(div); // displays the error on main
	
	$("error").innerHTML = "Error making Ajax request:" + 
		"\n\nServer status:\n" + ajax.status + " " + ajax.statusText + 
		"\n\nServer response text:\n" + ajax.responseText;
	if (exception) {
		throw exception;
	}
}

// it add items to the bottom of the list whenever the user type something on the
// textbox and clicks the the add button.
function addText() {
	var dolist = $("itemtext").value.escapeHTML();	
	if(dolist) {
		var li = document.createElement("li");
		
		// gives id's to the elements that gets added to the list
		li.id = "item" + "_" + ($$("#todolist li").length);	

		li.innerHTML = dolist;
		$("todolist").appendChild(li);
	}
	
	visualEffect();	// allows to change order and shake the elements
	myAjaxRequest("post", getTodoList(), undefined);
}

// the method adds effects and an Ajax request on update.
function listUpdate(list) {
	list.shake();
	myAjaxRequest("post", getTodoList(), undefined);
}

// delets items from the top of the list and highlits the element that 
// will get deleted from the list.
function deleteText() {
	var dolist = $("todolist").innerHTML;	
	if(dolist) {
		var text = $$("#todolist li");
		text[0].highlight({  
			afterFinish: function() {
				text[0].remove(); 
				myAjaxRequest("post", getTodoList(), undefined);
			}
		});
	}
}

// Whenever a post request is made the method gets called. 
// it creates an object to hold the elemets on the list in order
// to manage the state of the object. 
function getTodoList() {
	var bulletedList = $$("#todolist li");
	var json = {items:[]};
	for(var i = 0; i < bulletedList.length; i++) {
		json.items.push(bulletedList[i].innerHTML);	
	}
	return JSON.stringify(json);
}
