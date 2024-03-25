import urllib.parse
import requests
from requests.auth import HTTPBasicAuth

baseUrl = "https://onlinetools.ups.com/security/v1/oauth/token"

def generateToken(clientId, clientSecret, headers, postData, queryParams):
    
    if clientId is None or clientId.isspace() or clientSecret is None or clientSecret.isspace():
        raise ValueError("clientId and clientSecret are required.")        

    url = baseUrl
    authorization = HTTPBasicAuth(clientId, clientSecret)
    httpHeaders = {
                    "Content-Type" : "application/x-www-form-urlencoded",
                    "Cookie" : "ups_language_preference=en_US" 
                  }

    body = { "grant_type": "client_credentials" }
    
    query = {}

    if headers is not None:
        for key, value in headers.items():
            httpHeaders[key] = value

    if postData is not None:
        claims = ""
        for key, value in postData.items():
            claims += "{\"sessionid\":\"" + value + "\"}"
        body["custom_claims"] = claims
            
    if queryParams is not None:
        for key, value in queryParams.items():
            query[key] = value
            
    value = ""
    response = requests.post(url, auth = authorization, headers = httpHeaders, data = body, params = query).json()
    try:
        value = response['access_token']
    except :
        if 'clientid is invalid' in str(response).lower():
            value = __generateError("\"DTG001\"")
            raise Exception(value)
        elif 'missing client id' in str(response).lower():
            value = __generateError("\"DTG002\"")
            raise Exception(value)
        elif 'client credentials are invalid' in str(response).lower():
            value = __generateError("\"DTG003\"")
            raise Exception(value)
        elif 'grant' in str(response).lower():
            value = __generateError("\"DTG004\"")
            raise Exception(value)
        elif "redirect" in str(response).lower():
            value = __generateError("\"DTG005\"")
        elif "authorization code" in str(response).lower():
            value = __generateError("\"DTG006\"")
        elif "authorization header" in str(response).lower():
            value = __generateError("\"DTG007\"")
        elif "quota" in str(response).lower():
            value = __generateError("\"DTG008\"")
        else:
            value = __generateError("\"DTG009\"")
            raise Exception(value)
    finally:
        return value

def __generateError(code):
    initial = "{\"response\":{\"errors\":[{\"code\":";
    final = ",\"message\":\"Token generation has encountered an error. Please contact your UPS Relationship Manager.\"}]}}";
    message = initial + code + final
    return message

