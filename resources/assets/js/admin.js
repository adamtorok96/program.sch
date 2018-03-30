class ProgramAdmin {
    static get Circles() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.circles.show', value, {
                    circle: data.id
                });
            }

            static formatResort(value, data) {
                return data.resort === null ? '' : laroute.link_to_route('admin.resorts.show', value, {
                    resort: data.resort.id
                });
            }
        }
    }

    static get Users() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.users.show', value, {
                    user: data.id
                });
            }
        }
    }
}

window.PA = ProgramAdmin;