const apikey="5Y5OQARVvCvfm88EOu1pnlfSqpjf2rwM";
export default Object.freeze({
  GetEventsValue: {
    url: "EventsJsonUrl",
    method: "GET",
    params: {  page: 0, size: 0, keyword: "" , sort: "", apikey: apikey,},
    header: {
      addToken: 0,
      multipart: 1,
      addurl: 1,
    },
  },
  GetSingleEvent: {
    url: "GetSingleEventUrl",
    method: "GET",
    params: {  id: "", apikey: apikey },
    header: {
      addToken: 0,
      multipart: 1,
      addurl: 1,
    },
  },
});