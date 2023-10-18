import React, { Component } from "react";
import { Link } from "react-router-dom";
import Cards from "react-credit-cards";
import { Button, Card, Col, Form, Row } from "react-bootstrap";
import "react-credit-cards/es/styles-compiled.css";
import {
  formatCreditCardNumber,
  formatCVC,
  formatExpirationDate,
  tokenize,
  PaymentMethodsURL
} from "./utils";

import { ConektaAPI } from '../constants/api';

export default class PaymentForm extends Component {
  constructor(props) {
    super(props);
    console.log(ConektaAPI)
    this.state = {

      cvc: "",
      expiry: "",
      focus: "",
      name: "",
      number: "",

    };

    this.setName = this.setName.bind(this);
    this.onChange = this.onChange.bind(this);
    this.onSubmit = this.onSubmit.bind(this);
  }

  setName(e) {
    this.setState({
      [name]:e.value
    });
  }

  async onSubmit(e) {
    e.preventDefault();

    const { number, name, cvc, expiry } = this.state;

    const tokenParams = tokenize({ number, name, cvc, expiry });

    window.Conekta.setPublicKey("key_WtpsP5Uyz7QmMXCZxqzp8Ng");

    window.Conekta.setLanguage("es");

    window.Conekta.Token.create(
      tokenParams,
      async (token) => {
        try {
          const userId = this.props.user_id;

          const response = await fetch(ConektaAPI.addCard, {
            method: "POST",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              user_id: Number(userId),
              conekta_token_id: token.id,
            }),
          });

          console.log(token);

          const result = await response.json();

          console.log(result);

          if (result.source) {
            alert("Card saved successfully.");

            // this.props.history.push(PaymentMethodsURL.index);
            location.reload();
          } else {
            console.log(result);
          }
        } catch (error) {
          console.log(error);
        }
      },
      (error) => {
        console.log(error);
      }
    );
  }

  onChange({ target }) {
    if (target.name === "number") {
      target.value = formatCreditCardNumber(target.value);
    } else if (target.name === "expiry") {
      target.value = formatExpirationDate(target.value);
    } else if (target.name === "cvc") {
      target.value = formatCVC(target.value);
    }

    this.setState({ [target.name]: target.value });
  }

  render() {
    return (
      <div className="animated fadeIn">
        <Card>
          <Card.Header as="h6" className="admin-card-header">
            <i className="fa fa-credit-card"></i> Nueva tarjeta
          </Card.Header>

          <Card.Body>
            <div className="mb-4">
              <Cards
                cvc={this.state.cvc}
                expiry={this.state.expiry}
                focused={this.state.focus}
                name={this.state.name}
                number={this.state.number}
                placeholders={{ name: "Nombre del titular" }}
                locale={{ valid: "Válida hasta" }}
                callback={this.callback}
              />
            </div>

            <Form id="add-card" onSubmit={this.saveCard}>
              <Row>
                <Col sm="12">
                  <Form.Group controlId="number">
                    <Form.Label>Número tarjeta</Form.Label>

                    <Form.Control
                      name="number"
                      onChange={this.onChange}
                      onFocus={this.onFocus}
                      placeholder="Número tarjeta"
                      required
                      type="tel"
                    />
                  </Form.Group>
                </Col>
              </Row>

              <Row>
                <Col sm="12">
                  <Form.Group controlId="name">
                    <Form.Label>Nombre del titular de la tarjeta</Form.Label>

                    <Form.Control
                      name="name"
                      onChange={this.onChange}
                      onFocus={this.onFocus}
                      placeholder="Nombre del titular de la tarjeta"
                      required
                      type="text"
                    />
                  </Form.Group>
                </Col>
              </Row>

              <Row>
                <Col sm="6">
                  <Form.Group controlId="expiry">
                    <Form.Label>Expira en </Form.Label>

                    <Form.Control
                      name="expiry"
                      onChange={this.onChange}
                      onFocus={this.onFocus}
                      pattern="\d\d/\d\d"
                      placeholder="Expira en"
                      required
                      type="tel"
                    />
                  </Form.Group>
                </Col>

                <Col sm="6">
                  <Form.Group controlId="cvc">
                    <Form.Label>CVC</Form.Label>

                    <Form.Control
                      name="cvc"
                      onChange={this.onChange}
                      onFocus={this.onFocus}
                      pattern="\d{3,4}"
                      placeholder="CVC"
                      required
                      type="tel"
                    />
                  </Form.Group>
                </Col>
              </Row>
            </Form>
          </Card.Body>

          <Card.Footer>
            // <Button className="mr-1" form="add-card" type="submit" onClick={this.onSubmit}>
            //   Guardar tarjeta
            // </Button>

          </Card.Footer>
        </Card>
      </div>
    );
  }
}
