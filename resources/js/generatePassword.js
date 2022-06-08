import {HomeIcon} from "@heroicons/vue/outline";

const size = 32
const characters = 'a-z,A-Z,0-9,#'

export const strengthLevels = { 1: 'Weak', 2: 'Fair', 3: 'Good', 4: 'Strong' };

export const generatePassword = () => {

    let charactersArray = characters.split(',')
    let CharacterSet = ''
    let password = ''

    if( charactersArray.indexOf('a-z') >= 0) {
        CharacterSet += 'abcdefghijklmnopqrstuvwxyz';
    }
    if( charactersArray.indexOf('A-Z') >= 0) {
        CharacterSet += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    if( charactersArray.indexOf('0-9') >= 0) {
        CharacterSet += '0123456789';
    }
    if( charactersArray.indexOf('#') >= 0) {
        CharacterSet += '![]{}()%&*$#^<>~@|';
    }

    for(let i=0; i < size; i++) {
        password += CharacterSet.charAt(Math.floor(Math.random() * CharacterSet.length));
    }

    return  password;
}
