


class Messages {

    constructor() {
        if (!Messages.instance) {
            this._data = [];
            Messages.instance = this;
        }

        return Messages.instance;
    }



    send() {
        //
    }

    get() {

    }

    show() {
        //
    }
    create() {

        //
    }
}


const instance = new Messages();
Object.freeze(instance);
export default instance;