import axios from 'axios';
export default (header) => {
  let headers = header || {};
  const ax = axios.create({
    // api'in çalıştığı port
    baseURL: 'https://app.ticketmaster.com/discovery/v2',
    withCredentials: false,
    headers: headers,
  });
  return ax;
}; 