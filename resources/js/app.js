import './bootstrap.js';

document.addEventListener('DOMContentLoaded',function(){
	const passgen = (length) => {
		
			let result = '';
			const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			const charactersLength = characters.length;
			let counter = 0;
			while (counter < length) {
			  result += characters.charAt(Math.floor(Math.random() * charactersLength));
			  counter += 1;
			}
			return result; 
		
	} 

	
	

	var buttons = document.querySelectorAll('.pass-fill')
	buttons.forEach(button => {
		button.addEventListener('click',function(){
			var targetInput = button.getAttribute('data');
			var inputs = document.querySelectorAll('.'+targetInput);
			
			if(inputs === null) return;
			
			var password = passgen(12);
			inputs.forEach(input => {
				
				input.value = password;
			});
		});
	});


});