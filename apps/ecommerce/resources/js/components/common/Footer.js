import React from "react";
import { Link } from "react-router-dom";
import { Navbar, Container, Row, Table, Col } from "react-bootstrap";

class Footer extends React.Component {
    render() {
        return (
            <footer className="footer">
                <Navbar>
                    <Container>
                        <Row>
                            <Col className="offset-lg-2">
                                <br />
                                <Table responsive className="table-footer">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <Link to={"/myaccount"}>
                                                    My Account
                                                </Link>
                                            </td>
                                            <td>
                                                <Link to={"/about"}>
                                                    About Project
                                                </Link>
                                            </td>
                                            <td>
                                                <Link to={"/people"}>
                                                    People
                                                </Link>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <Link to={"/myorders"}>
                                                    My Orders
                                                </Link>
                                            </td>
                                            <td>
                                                <Link to={"/contact"}>
                                                    Contact
                                                </Link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </Table>
                            </Col>
                        </Row>
                        <Row>
                            <Col lg="12">
                                <div className="text-center copyright-height">
                                    Copyright &copy; {new Date().getFullYear()}
                                </div>
                            </Col>
                        </Row>
                    </Container>
                </Navbar>
            </footer>
        );
    }
}

export default Footer;
