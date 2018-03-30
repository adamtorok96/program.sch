class ProgramAdmin {
    static get Programs() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.programs.show', value, {
                    program: data.id
                });
            }

            static formatCircle(value, data) {
                return laroute.link_to_route('admin.circles.show', value, {
                    circle: data.circle.id
                });
            }

            static formatUser(value, data) {
                return laroute.link_to_route('admin.users.show', value, {
                    user: data.user.id
                });
            }

            static queryParams(params) {
                if( $("#only_poster").is(":checked") )
                    params.only_poster = true;

                if( $("#only_email").is(":checked") )
                    params.only_email = true;

                return params;
            }

            static reload() {
                $("table[data-toggle='table']").bootstrapTable('refresh');
            }
        }
    }

    static get Resorts() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.resorts.show', value, {
                    resort: data.id
                });
            }
        }
    }

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

    static get Locations() {
        return class {
            static formatName(value, data) {
                return laroute.link_to_route('admin.locations.show', value, {
                    location: data.id
                });
            }
        }
    }
}

window.PA = ProgramAdmin;