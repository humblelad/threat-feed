# -*- coding: utf-8 -*-

# Sample Python code for youtube.search.list
# See instructions for running these code samples locally:
# https://developers.google.com/explorer-help/guides/code_samples#python

import os
import time
import psycopg2
import googleapiclient.discovery

def main():

    #Disable OAuthlib's HTTPS verification when running locally.
   # *DO NOT* leave this option enabled in production.
    os.environ["OAUTHLIB_INSECURE_TRANSPORT"] = "1"

    api_service_name = "youtube"
    api_version = "v3"
    DEVELOPER_KEY = "enterkeyhere"

    youtube = googleapiclient.discovery.build(
        api_service_name, api_version, developerKey = DEVELOPER_KEY)

    request = youtube.search().list(
        part="id",
        #eventType="complete",
        eventType="none",
        maxResults=10,
        order="date",
        #enter the query to perform threat analysis
        q="google|facebook",
        #q="test",
        type="video"
    )
    response = request.execute()

    #print(response)
    # y = json.loads(response)

    lol = (response["items"])
    #print(lol)
    i = 0
    while i < len(lol):
        ho = lol[i]
        final = ho["id"]
        v = final["videoId"]
        #print(v)
        i = i + 1
        dbSession = psycopg2.connect("dbname='mydb' user='myusername' password='mypassword'");
        dbCursor = dbSession.cursor();
        
        sqlInsertRow1 = "INSERT INTO initial(videoid)" \
                        "SELECT * FROM(SELECT '{0}') as i(videoid) WHERE NOT EXISTS(SELECT FROM delete d where d.deleteid=i.videoid) ON CONFLICT(videoid) DO NOTHING".format(v);
        dbCursor.execute(sqlInsertRow1);
        dbSession.commit();
        dbSession.close();
    print("Query Ran");
    time.sleep(18000);

if __name__ == "__main__":
    main()
    while True:
        main()
