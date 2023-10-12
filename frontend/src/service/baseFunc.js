import config from "../service/urls";
import api from "../service/apiBase";

const hasKey = (data, key) => Object.prototype.hasOwnProperty.call(data, key)
const getHeaderType = (header, headers) => {
  if (header.multipart == 1) {
    headers["Content-Type"] = "application/json";
  } 
  return headers;
};
const getData = (api, method, thisUrl, form, headers, header) => {
  return new Promise((resolve, reject) => {
    let response = null
    if (method === 'GET') {
      response = api(headers, header.responsetype).get(thisUrl)
    } 
    else if (method === 'POST') {
      response = api(headers).post(thisUrl, form)
    } 
    if (response !== null) {
      response.then(res => {
        resolve(res)
      }).catch(err => {
        reject(err)
      });
    } 
    else {
      reject(new Error('Method Issues'))
    }
  });
}

const baseFunc = (base, data, uri, method = "GET", header = {}) => {
  let form = null;
  let thisUrl = "";
  let headers = getHeaderType(header, {});
  data = data || {};
  const objs = [{}, base, data];
  const out = Object.assign(...objs);
  if (hasKey(config, uri)) {
    thisUrl = config[uri];
  }
  if (thisUrl !== "") {
    if (hasKey(header, "addurl") && header.addurl) {
      Object.keys(out).forEach((elem) => {
        if (thisUrl.indexOf("{{" + elem + "}}") !== -1) {
          thisUrl = thisUrl.replace("{{" + elem + "}}", out[elem]);
          delete out[elem];
        }
      });
    }
    if (method === "GET") {
      var queryString = Object.keys(out)
        .map((key) => key + "=" + out[key])
        .join("&");
      if (queryString.length > 0) thisUrl = thisUrl + "?" + queryString;
      return getData(api, method, thisUrl, {}, headers, header)
    }  
  }
  else {
      return new Promise(reject => {
        reject(null)
      })
    }
  }

export default baseFunc;