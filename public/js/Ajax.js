class Ajax 
{
	constructor() {};

	sendData(url, data, callback, type = null)
	{
		var req = new XMLHttpRequest();
    	req.open("POST", url);
    	req.addEventListener("load", () => 
    	{ 
    		if (type === "json")
    		{
    			callback(JSON.parse(req.responseText))
    		}
    		else
    		{
    			callback(req.responseText);
    		}
		});
		if(type !== "formData")
		{
			req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		};
		req.send(data);
	};
};