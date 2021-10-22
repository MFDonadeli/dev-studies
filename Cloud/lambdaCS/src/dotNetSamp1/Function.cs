using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Threading.Tasks;

using Amazon.Lambda.Core;
using Amazon.Lambda.APIGatewayEvents;
using System.Text.Json;

using Amazon.S3;
using Amazon.S3.Model;
using System.IO;

// Assembly attribute to enable the Lambda function's JSON input to be converted into a .NET class.
[assembly: LambdaSerializer(typeof(Amazon.Lambda.Serialization.SystemTextJson.DefaultLambdaJsonSerializer))]

namespace dotNetSamp1
{
    public class Functions
    {
        private ITimeProcessor processor = new TimeProcessor();

        /// <summary>
        /// Default constructor that Lambda will invoke.
        /// </summary>
        public Functions()
        {
        }

        /// <summary>
        /// A Lambda function to respond to HTTP Get methods from API Gateway
        /// </summary>
        /// <param name="request"></param>
        /// <returns>The API Gateway response.</returns>
        public APIGatewayProxyResponse Get(APIGatewayProxyRequest request, ILambdaContext context)
        {
            context.Logger.LogLine("Get Request\n");

            var result = processor.CurrentTimeUTC();

            string aaa = "nada";

            try
            {
                var values = request.QueryStringParameters;
                bool hasValue = values.TryGetValue("url", out aaa);
            }
            catch
            {
                aaa = "oi";
            }

            aaa = FunctionHandler(aaa).Result;

            return new APIGatewayProxyResponse
            {
                StatusCode = 200,
                Body = aaa,
                Headers = new Dictionary<string, string>
                {
                    { "Content-Type", "application/json" },
                    { "Access-Control-Allow-Origin", "*" }
                }
            };
        }

        public async Task<string> FunctionHandler(string url)
        {
            var S3Client = new AmazonS3Client("xxx", "xxx");

            var response = await S3Client.GetObjectAsync("dummies-devb-static", "urlmaptable.json");

            MemoryStream memoryStream = new MemoryStream();

            string return1;
            JsonStruct[] Obj;
            using (StreamReader responseStream = new StreamReader(response.ResponseStream))
            {
                var content = responseStream.ReadToEnd();
                Obj = JsonSerializer.Deserialize<JsonStruct[]>(content);
            }

            return Array.Find(Obj, element => element.oldurl.Contains(url)).newurl;

            /*
            int statusCode = (result != null) ?
                (int)HttpStatusCode.OK :
                (int)HttpStatusCode.InternalServerError;

            Console.WriteLine(result.ToString());

            string body = (result != null) ?
                JsonSerializer.Serialize(result) : string.Empty;

            var response = new APIGatewayProxyResponse
            {
                StatusCode = statusCode,
                Body = body,
                Headers = new Dictionary<string, string>
                {
                    { "Content-Type", "application/json" },
                    { "Access-Control-Allow-Origin", "*" }
                }
            };

            return response;*/
        }
    }

    internal class JsonStruct
    {
        public string oldurl { get; set; }
        public string newurl { get; set; }
    }
}