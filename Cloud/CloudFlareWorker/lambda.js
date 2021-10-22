exports.handler = async (event) => {
    
    // TODO implement
    const redirectMap = new Map([
  ['/games/building-3d-digital-games','https://www.devb.dummies.com/home'],
  ['/education/language-arts/grammar/english-grammar-essentials-for-dummies-australian-edition','https://www.devb.dummies.com/home'],
  ['/games/crossword-puzzles/cryptic-crossword-puzzles-for-dummies-australian-edition','https://www.devb.dummies.com/home'],
  ['/business/start-a-business/getting-started-in-small-business-for-dummies-third-australian-and-new-zealand-edition','https://www.devb.dummies.com/home'],
  ['/computers/pcs/computer-games/fortnite-for-dummies','https://www.devb.dummies.com/home'],
  ['/software/adobe/adobe-lightroom-for-dummies-2nd-edition','https://www.devb.dummies.com/home']])
    
    var url = "not"
    if (event.queryStringParameters && event.queryStringParameters.url) {
        console.log("Received name: " + event.queryStringParameters.url);
        url = event.queryStringParameters.url;
    }
    
    const location = redirectMap.get(url);
    
    const response = {
        statusCode: 200,
        body: JSON.stringify(location),
    };
    return response;
};
