import {NgModule} from "@angular/core";
import {LayoutComponent} from "./layout.component";
import {SidebarComponent} from "./sidebar/sidebar.component";
import {NavbarComponent} from "./navbar/navbar.component";
import {LayoutRoutingModule} from "./layout-routing.module";
import {CommonModule} from "@angular/common";

@NgModule({
    imports: [LayoutRoutingModule,CommonModule],
    exports: [],
    declarations: [LayoutComponent,SidebarComponent,NavbarComponent],
    providers: [],
})
export class LayoutModule { }
