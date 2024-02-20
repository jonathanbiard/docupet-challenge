import axios from 'axios'
import { apiUrl } from './ApiConstants'

const PetService = {
    getAll: async () => {
        let result

        try {
            result = await axios({
                method: 'get',
                url: `${apiUrl}/pet`
            })

            if (result.data) {
                return result.data
            }
        } catch (error) {
            // let it return [] below...
        }

        return []
    },
    getById: async (id) => {
        let result

        try {
            result = await axios({
                method: 'get',
                url: `${apiUrl}/pet/${id}`
            })

            if (result.data) {
                return result.data
            }
        } catch (error) {
            // let it return null below...
        }

        return null
    },
    save: async ($pet) => {
        let result

        try {
            result = await axios({
                method: 'post',
                url: `${apiUrl}/pet`,
                data: {
                    name: $pet.name,
                    breed: $pet.breed,
                    breedMix: $pet.breedMix,
                    birthday: $pet.birthday,
                    age: $pet.age,
                    gender: $pet.gender,
                },
            })

            if (result.status === 201) {
                return true
            }
        } catch (error) {
            // let it return false below...
        }

        return false
    }
}

export default PetService
