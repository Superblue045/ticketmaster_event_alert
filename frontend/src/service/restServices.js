import createService from './createService'
import values from './defaultValues'
const avaible = Object.keys(values)
let services = {}
avaible.forEach(n => {
  services[n] = createService(values[n])
})
export { services }
