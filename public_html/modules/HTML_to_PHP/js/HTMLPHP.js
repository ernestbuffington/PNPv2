<SCRIPT>
function htmlphp(){
	var input = document.htphp.input.value;
	output = "echo\"";
	for (var c = 0; c < input.length; c++){
		if ((input.charAt(c) == "\n" || input.charAt(c) == "\r")){
			output += "\"";
			if (c != input.length - 1) output +="\n  . \"";
			c++;
			}
		else {
			if (input.charAt(c) == "\"") {
				output += "\\\"";
				}
			else {
				if (input.charAt(c) == "\\"){
					output += "\\\\";
					}
				else {
					output += input.charAt(c);
					if (c == input.length -1) output += "\"";	
					}
				}
			}
		
		}

info="<\?php\n" + 
"#### Generated by the PHP-Nuke Platinum Html to PHP converter ####\n" +

"\n\n"




info2="\n \.\"\";\n" +

"\n?>";

	document.htphp.output.value =info+output+info2;
}

</SCRIPT>