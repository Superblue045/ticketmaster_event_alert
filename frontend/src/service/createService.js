import baseFunct from '../service/baseFunc'
export default function (args) {
  let base = args.params || {}
  let url = args.url || ""
  let header = args.header || {}

  return (data) => {
    data = data || {}
    return baseFunct(base, data, url, args.method, header)
  }
}
