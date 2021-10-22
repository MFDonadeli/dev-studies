const url = "https://i361ja6ded.execute-api.us-east-1.amazonaws.com/?url="
const redirectHost = "https://www.devb.dummies.com"
/**
 * gatherResponse awaits and returns a response body as a string.
 * Use await gatherResponse(..) in an async function to get the response body
 * @param {Response} response
 */
async function gatherResponse(response) {
  const { headers } = response
  const contentType = headers.get("content-type") || ""
  if (contentType.includes("application/json")) {
    return await response.text()
  }
  else if (contentType.includes("application/text")) {
    return response.text()
  }
  else if (contentType.includes("text/html")) {
    return response.text()
  }
  else {
    return response.text()
  }
}

var data = "";

async function handleRequest(request) {
  const init = {
    headers: {
      "content-type": "application/json;charset=UTF-8",
    },
  }

  const requestURL = new URL(request.url)
  const path = requestURL.pathname

  const response = await fetch(url+path, init)
  data = await gatherResponse(response)

  //const requestURL = new URL(request.url)
  //const path = requestURL.pathname

  if(data) {
    let finalString = data.replace(/["]+/g, '')
    return Response.redirect(finalString, 301)
  }
  else {
    return fetch(request)
  }
  
  //return new Response(res[0].newurl, init)
}

addEventListener('fetch', event => {
  event.respondWith(handleRequest(event.request))
})